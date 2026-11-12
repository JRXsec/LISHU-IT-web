# LISHU-IT · Web corporativa

Web de **LISHU-IT**, empresa ficticia de ciberseguridad y auditoría de dispositivos IoT. Proyecto de fin de curso.

Hay dos formas de verla. **No hace falta tener nada descargado de antes.**

---

## Opción A · Abrirla en el navegador (no se descarga ni se instala nada)

La web se ejecuta en un ordenador de GitHub y tú la ves en tu navegador.

1. Entra en <https://github.com> e inicia sesión. Si no tienes cuenta, créala, es gratis.
2. Haz clic en este enlace: 👉 **[Abrir la web en Codespaces](https://codespaces.new/JRXsec/LISHU-IT-web?quickstart=1)**
3. Pulsa el botón verde **Create codespace**.
4. Espera 1-2 minutos mientras se prepara. Se abre un editor de código y, poco después, **la web en una pestaña nueva**.
   - Si la pestaña no se abre sola: en la parte de abajo del editor, pulsa la pestaña **PORTS**, busca el puerto **8000** y pulsa el icono del globo 🌐.
   - Si el navegador bloquea la ventana emergente, permítela.

Cuando termines, cierra la pestaña. Se apaga solo al rato.

---

## Opción B · Descargarla y abrirla en tu ordenador

### 1. Descarga la web

Haz clic aquí: 👉 **[Descargar LISHU-IT-web.zip](https://github.com/JRXsec/LISHU-IT-web/archive/refs/heads/main.zip)**

Descomprime el ZIP (clic derecho → **Extraer todo**). Te queda una carpeta llamada **`LISHU-IT-web-main`**.

### 2. Instala PHP (solo la primera vez)

PHP es el programa que hace funcionar la web.

- **Windows:** abre el menú Inicio, escribe `terminal`, ábrela y pega esto:
  ```
  winget install PHP.PHP.8.3
  ```
  Cuando termine, **cierra la terminal**.
- **macOS:** en la Terminal: `brew install php`
- **Linux (Ubuntu/Debian):** en la terminal: `sudo apt install php-cli`

### 3. Abre una terminal dentro de la carpeta

- **Windows:** entra en la carpeta `LISHU-IT-web-main` (la que tiene dentro `src`, `README.md`…), haz **clic derecho en un hueco vacío → Abrir en Terminal**.
- **macOS / Linux:** abre la terminal, escribe `cd ` (con un espacio) y arrastra la carpeta a la ventana. Pulsa Enter.

### 4. Arranca la web

En esa terminal, pega esto y pulsa Enter:

```
php -S localhost:8000 -t src router.php
```

Si sale algo como `Development Server (http://localhost:8000) started`, ya está.

### 5. Ábrela

Entra en 👉 <http://localhost:8000> con tu navegador.

Mientras la terminal esté abierta, la web funciona. Para apagarla, pulsa `Ctrl + C` en la terminal o ciérrala.

---

### ¿Algo no va?

| Problema | Solución |
|---|---|
| `php no se reconoce como un comando` | Cierra la terminal y abre una nueva (paso 3). Si sigue, repite el paso 2. |
| `Could not open input file: router.php` | La terminal no está en la carpeta correcta. Repite el paso 3 dentro de `LISHU-IT-web-main`. |
| `Address already in use` | Ya la tienes abierta en otra terminal. Usa esa o ciérrala. |

---

🔑 Panel interno con los mensajes del formulario de contacto: `/admin.php` · contraseña `lishu2026`
