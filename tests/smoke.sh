#!/usr/bin/env bash
# Pruebas automáticas de la web (se ejecutan en GitHub Actions y en local).
#   bash tests/smoke.sh            -> arranca el servidor de PHP y prueba todo
#   BASE=http://localhost:8080 bash tests/smoke.sh   -> prueba un servidor ya arrancado
set -u
cd "$(dirname "$0")/.."

PORT=8765
BASE="${BASE:-}"
export LISHU_DATA_DIR="${LISHU_DATA_DIR:-$(mktemp -d)}"
if [ -z "$BASE" ]; then
  php -S 127.0.0.1:$PORT -t src router.php >/tmp/lishu-server.log 2>&1 &
  PID=$!
  trap 'kill $PID 2>/dev/null' EXIT
  BASE="http://127.0.0.1:$PORT"
  sleep 1
fi

FALLOS=0
JAR=$(mktemp)
ok()   { echo "  OK   $1"; }
mal()  { echo "  FALLO $1"; FALLOS=$((FALLOS+1)); }

estado() { curl -s -o /dev/null -w '%{http_code}' "$@"; }

echo "== Sintaxis PHP"
for f in $(find src router.php -name '*.php'); do
  php -l "$f" >/dev/null 2>&1 && ok "$f" || mal "php -l $f"
done

echo "== Páginas (200 y contenido)"
comprobar() { # url texto
  local cuerpo; cuerpo=$(curl -s "$BASE/$1")
  local cod; cod=$(estado "$BASE/$1")
  if [ "$cod" = "200" ] && grep -qF -- "$2" <<<"$cuerpo"; then ok "/$1 -> $2"; else mal "/$1 (código $cod, buscaba '$2')"; fi
  if grep -qiE 'Warning:|Notice:|Fatal error|Deprecated:' <<<"$cuerpo"; then mal "/$1 muestra errores de PHP"; fi
}
comprobar ""               "Ciberseguridad y auditoría para todo"
comprobar "index.php"      "Propuesta de valor"
comprobar "index.php"      "Deloitte Cyber"
comprobar "servicios.php"  "Pyme Segura"
comprobar "servicios.php"  "Preguntas frecuentes"
comprobar "sectores.php"   "Hoteles y edificios"
comprobar "nosotros.php"   "Nuestra historia"
comprobar "contacto.php"   "Solicita tu auditoría"
comprobar "admin.php"      "Panel interno"
comprobar "assets/css/style.css" "--teal"
comprobar "assets/js/main.js"    "IntersectionObserver"

echo "== Seguridad"
[ "$(estado "$BASE/includes/datos.php")" = "404" ] && ok "/includes bloqueado" || mal "/includes accesible"
[ "$(estado "$BASE/no-existe")" = "404" ] && ok "404 en página inexistente" || mal "sin 404"
curl -sI "$BASE/" | grep -qi 'X-Content-Type-Options: nosniff' && ok "cabeceras de seguridad" || mal "faltan cabeceras"

echo "== Formulario de contacto"
FORM=$(curl -s -c "$JAR" -b "$JAR" "$BASE/contacto.php")
TOKEN=$(grep -o 'name="csrf" value="[a-f0-9]*"' <<<"$FORM" | sed 's/.*value="//;s/"//')
[ -n "$TOKEN" ] && ok "token CSRF presente" || mal "no hay token CSRF"

# Envío sin token -> error
R=$(curl -s -c "$JAR" -b "$JAR" --data-urlencode "nombre=X" "$BASE/contacto.php")
grep -q 'La sesión ha caducado' <<<"$R" && ok "rechaza envío sin token" || mal "acepta envío sin token"

# Envío con datos malos -> errores de validación
FORM=$(curl -s -c "$JAR" -b "$JAR" "$BASE/contacto.php")
TOKEN=$(grep -o 'name="csrf" value="[a-f0-9]*"' <<<"$FORM" | sed 's/.*value="//;s/"//')
R=$(curl -s -c "$JAR" -b "$JAR" --data-urlencode "csrf=$TOKEN" --data-urlencode "nombre=<script>alert(1)</script>" \
    --data-urlencode "email=no-es-email" --data-urlencode "mensaje=corto" "$BASE/contacto.php")
grep -q 'El email no es válido' <<<"$R" && ok "valida email" || mal "no valida email"
grep -q '<script>alert(1)</script>' <<<"$R" && mal "XSS: no escapa la entrada" || ok "escapa la entrada (XSS)"

# Envío correcto -> 302 y mensaje guardado
FORM=$(curl -s -c "$JAR" -b "$JAR" "$BASE/contacto.php")
TOKEN=$(grep -o 'name="csrf" value="[a-f0-9]*"' <<<"$FORM" | sed 's/.*value="//;s/"//')
COD=$(curl -s -o /dev/null -w '%{http_code}' -c "$JAR" -b "$JAR" \
  --data-urlencode "csrf=$TOKEN" \
  --data "nombre=Prueba%20Autom%C3%A1tica" \
  --data-urlencode "email=prueba@example.com" --data-urlencode "empresa=Clase ASIR" \
  --data-urlencode "tipo=Pymes" \
  --data "interes=Diagn%C3%B3stico%20gratuito" \
  --data "mensaje=Tenemos%2012%20c%C3%A1maras%20IP%20y%20queremos%20una%20auditor%C3%ADa." \
  --data-urlencode "privacidad=si" "$BASE/contacto.php")
# (los acentos van ya codificados en %XX para que el test funcione igual en Windows y Linux)
[ "$COD" = "302" ] && ok "envío correcto redirige (302)" || mal "envío correcto devolvió $COD"
R=$(curl -s -c "$JAR" -b "$JAR" "$BASE/contacto.php?enviado=1")
grep -q 'Gracias, Prueba Automática' <<<"$R" && ok "muestra confirmación" || mal "sin confirmación"
if [ -z "${SKIP_FILE_CHECK:-}" ]; then
  grep -q 'Prueba Automática' "$LISHU_DATA_DIR/mensajes.csv" 2>/dev/null && ok "mensaje guardado en CSV" || mal "mensaje no guardado"
fi

echo "== Panel interno"
LOGIN=$(curl -s -c "$JAR" -b "$JAR" "$BASE/admin.php")
TOKEN=$(grep -o 'name="csrf" value="[a-f0-9]*"' <<<"$LOGIN" | sed 's/.*value="//;s/"//')
R=$(curl -s -c "$JAR" -b "$JAR" --data-urlencode "csrf=$TOKEN" --data-urlencode "clave=mala" "$BASE/admin.php")
grep -q 'Contraseña incorrecta' <<<"$R" && ok "rechaza contraseña mala" || mal "acepta contraseña mala"
TOKEN=$(grep -o 'name="csrf" value="[a-f0-9]*"' <<<"$R" | sed 's/.*value="//;s/"//')
curl -s -o /dev/null -c "$JAR" -b "$JAR" --data-urlencode "csrf=$TOKEN" --data-urlencode "clave=${LISHU_ADMIN_PASS:-lishu2026}" "$BASE/admin.php"
R=$(curl -s -c "$JAR" -b "$JAR" "$BASE/admin.php")
grep -q 'Prueba Automática' <<<"$R" && ok "el panel lista el mensaje" || mal "el panel no lista el mensaje"

rm -f "$JAR"
echo
if [ $FALLOS -eq 0 ]; then echo "TODO OK ✅"; else echo "$FALLOS FALLO(S) ❌"; [ -f /tmp/lishu-server.log ] && tail -20 /tmp/lishu-server.log; exit 1; fi
