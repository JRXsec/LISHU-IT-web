# LISHU-IT · Web corporativa

> **Ciberseguridad y auditoría para todo lo que está conectado.**
> Web de la empresa **ficticia** LISHU-IT, especializada en la seguridad de dispositivos IoT
> (cámaras, sensores, iluminación, domótica…). Proyecto de fin de curso.

[![Tests](https://github.com/JRXsec/LISHU-IT-web/actions/workflows/tests.yml/badge.svg)](https://github.com/JRXsec/LISHU-IT-web/actions/workflows/tests.yml)
[![Abrir en GitHub Codespaces](https://github.com/codespaces/badge.svg)](https://codespaces.new/JRXsec/LISHU-IT-web?quickstart=1)

---

## 🚀 Cómo verla funcionando (elige una)

### Opción 1 · En el navegador, sin instalar nada (GitHub Codespaces) ⭐ la más fácil

1. Inicia sesión en GitHub (cuenta gratuita).
2. Pulsa el botón **"Open in GitHub Codespaces"** de arriba
   (o en el repo: botón verde **Code → pestaña Codespaces → Create codespace on main**).
3. Espera 1-2 minutos a que se prepare. La web arranca sola y se abre en una pestaña nueva.
   - Si no se abre: abajo, pestaña **PORTS** → puerto **8000** → icono del globo 🌐.
   - Si la quieres arrancar a mano, en la terminal del Codespace:
     ```bash
     php -S 0.0.0.0:8000 -t src router.php
     ```
4. Cuando acabes, cierra la pestaña. GitHub da **60 horas gratis al mes**; el Codespace se para solo tras 30 min sin uso.

### Opción 2 · En tu PC con PHP

**1. Instala PHP 8.1 o superior** (solo la primera vez):

| Sistema | Comando |
|---|---|
| Windows | `winget install PHP.PHP.8.3` (y abre una terminal nueva) |
| macOS | `brew install php` |
| Ubuntu / Debian | `sudo apt install php-cli` |

Comprueba que funciona con `php -v`.

**2. Descarga el proyecto**: botón verde **Code → Download ZIP** (y descomprímelo), o con git:

```bash
git clone https://github.com/JRXsec/LISHU-IT-web.git
cd LISHU-IT-web
```

**3. Arranca la web** desde la carpeta del proyecto:

```bash
php -S localhost:8000 -t src router.php
```

**4. Abre** <http://localhost:8000> en el navegador. Para pararla: `Ctrl + C` en la terminal.

### Opción 3 · Con Docker (nginx + PHP-FPM)

Requiere Docker Desktop abierto.

```bash
docker compose up -d --build
```

Abre <http://localhost:8080>. Para pararla: `docker compose down`.

---

## 🗺️ Qué tiene la web

| Página | Contenido |
|---|---|
| **Inicio** (`index.php`) | Presentación, cifras, propuesta de valor, a quién protegemos, cómo trabajamos, por qué LISHU-IT, testimonios, competencia, canales y alianzas |
| **Servicios** (`servicios.php`) | 6 servicios, método en 5 pasos, planes y precios, normas y certificaciones, preguntas frecuentes |
| **Sectores** (`sectores.php`) | Industria, tecnológicas y domótica, hoteles y edificios, pymes y particulares: riesgos y casos de éxito |
| **Nosotros** (`nosotros.php`) | Quiénes somos, historia desde 2004, valores, equipo directivo, oficinas en 4 países, alianzas y canales |
| **Contacto** (`contacto.php`) | Formulario que guarda las solicitudes en el servidor |
| **Panel interno** (`admin.php`) | Lista de solicitudes recibidas (protegido con contraseña) |

🔑 **Contraseña del panel interno (demo):** `lishu2026`
Se cambia con la variable de entorno `LISHU_ADMIN_PASS`.

> Los datos (cifras, clientes, testimonios, equipo, oficinas…) son **inventados** para el proyecto.
> Las fotos son de [Unsplash](https://unsplash.com) (licencia libre) y se cargan desde su CDN.

---

## 🧱 Cómo está hecha

- **PHP puro**, sin frameworks, sin base de datos y sin dependencias → funciona en cualquier servidor con PHP 8.1+.
- **HTML + CSS propios** (responsive, se ve bien en móvil) y un poco de JavaScript solo para animaciones.
- **Toda la información de la empresa está en un único fichero**: [`src/includes/datos.php`](src/includes/datos.php).
  Para cambiar un texto, una cifra o una foto, se edita solo ese fichero.

```
LISHU-IT-web/
├── src/                      ← raíz de la web (lo que se publica)
│   ├── index.php, servicios.php, sectores.php, nosotros.php, contacto.php, admin.php, 404.php
│   ├── includes/
│   │   ├── datos.php         ← TODA la información de la empresa
│   │   ├── layout.php        ← cabecera, menú y pie comunes
│   │   ├── funciones.php     ← iconos SVG y utilidades
│   │   └── mensajes.php      ← guardar/leer solicitudes (CSV)
│   ├── assets/               ← css, js, imágenes
│   └── .htaccess             ← reglas para hostings con Apache
├── data/                     ← aquí se guardan las solicitudes (no se sube a git)
├── router.php                ← reglas para el servidor de desarrollo de PHP
├── nginx/default.conf        ← configuración para nginx
├── php/Dockerfile, docker-compose.yml   ← opción Docker
├── .devcontainer/            ← configuración de GitHub Codespaces
├── tests/smoke.sh            ← pruebas automáticas
└── .github/workflows/        ← GitHub Actions ejecuta las pruebas en cada push
```

### Seguridad (somos una empresa de ciberseguridad 😉)

- Toda salida se escapa con `htmlspecialchars` → protección contra **XSS**.
- Formularios con **token CSRF** de un solo uso y campo trampa (*honeypot*) contra bots.
- Validación de todos los campos **en el servidor** y patrón POST → Redirect → GET.
- Protección contra **inyección de fórmulas** al abrir el CSV en Excel.
- Cookies de sesión `HttpOnly` y `SameSite=Lax`; `session_regenerate_id` al iniciar sesión.
- Cabeceras `X-Frame-Options`, `X-Content-Type-Options` y `Referrer-Policy`.
- La carpeta `includes/` y los ficheros ocultos no son accesibles desde el navegador.

### Pruebas automáticas

```bash
bash tests/smoke.sh
```

Comprueba sintaxis PHP, que todas las páginas cargan, el 404, las cabeceras de seguridad,
el formulario (CSRF, validación, XSS, guardado) y el panel interno. En GitHub se ejecutan
solas en cada cambio con PHP 8.1, 8.3 y 8.4 y también con nginx + PHP-FPM en Docker.

---

## ☁️ Desplegar en un servidor o en la nube

La carpeta **`src/`** es la raíz web. Los mensajes se guardan en `../data/`
(o en la ruta indicada en la variable de entorno `LISHU_DATA_DIR`).

| Destino | Cómo |
|---|---|
| Hosting PHP compartido (Apache) | Subir el contenido de `src/` a `public_html/` por FTP. El `.htaccess` ya va incluido. |
| VM Linux (AWS EC2, Azure VM, Proxmox…) | `apt install nginx php-fpm`, copiar `src/` a `/var/www/html` y usar `nginx/default.conf` cambiando `fastcgi_pass php:9000` por el socket de php-fpm (p. ej. `unix:/run/php/php8.3-fpm.sock`). |
| Azure App Service (PHP) | Desplegar el repo y poner `src` como raíz del sitio. |
| AWS Elastic Beanstalk / Lightsail (PHP) | Subir el proyecto con `src` como *document root*. |
| Docker / Kubernetes | Usar `docker-compose.yml` como base. |

Para escalar con varios servidores web detrás de un balanceador, conviene llevar las
solicitudes a una base de datos compartida (MySQL/MariaDB) o a un almacenamiento común
en lugar del CSV local.

---

<sub>LISHU-IT es una empresa ficticia creada con fines educativos. Cualquier parecido con empresas reales es casualidad.</sub>
