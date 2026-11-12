# LISHU-IT · Web corporativa

Web de **LISHU-IT**, empresa ficticia de ciberseguridad y auditoría de dispositivos IoT. Proyecto de fin de curso.

[![Abrir en GitHub Codespaces](https://github.com/codespaces/badge.svg)](https://codespaces.new/JRXsec/LISHU-IT-web?quickstart=1)

---

## Opción 1 · Verla en el navegador sin instalar nada (la más fácil)

1. Inicia sesión en GitHub (la cuenta es gratis).
2. Pulsa el botón **"Open in GitHub Codespaces"** de arriba.
   También puedes ir al botón verde **Code → pestaña Codespaces → Create codespace on main**.
3. Espera 1-2 minutos. La web se abre sola en una pestaña nueva.
   - Si no se abre: abajo, pestaña **PORTS** → puerto **8000** → icono del globo 🌐.

## Opción 2 · Descargarla y abrirla en tu PC

**1. Instala PHP** (solo la primera vez):

| Sistema | Comando |
|---|---|
| Windows | `winget install PHP.PHP.8.3` (después abre una terminal nueva) |
| macOS | `brew install php` |
| Ubuntu / Debian | `sudo apt install php-cli` |

**2. Descarga el proyecto**: botón verde **Code → Download ZIP** y descomprímelo.
O, si usas git:

```bash
git clone https://github.com/JRXsec/LISHU-IT-web.git
```

**3. Abre una terminal dentro de la carpeta del proyecto** y arranca la web:

```bash
php -S localhost:8000 -t src router.php
```

**4. Abre** <http://localhost:8000> en el navegador.
Para pararla, pulsa `Ctrl + C` en la terminal.

## Opción 3 · Con Docker

Con Docker Desktop abierto, dentro de la carpeta del proyecto:

```bash
docker compose up -d --build
```

Abre <http://localhost:8080>. Para pararla: `docker compose down`.

---

🔑 Panel interno con los mensajes del formulario: `/admin.php` · contraseña `lishu2026`
