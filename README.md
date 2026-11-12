# LISHU-IT · Web corporativa (Docker + nginx + PHP)

Web de la empresa ficticia **LISHU-IT** (ciberseguridad y auditoría IoT) para el trabajo de fin de curso.

## Arquitectura

```
Navegador ──HTTP:8080──▶ [ nginx ] ──FastCGI:9000──▶ [ php-fpm ]
                          sirve CSS/SVG               ejecuta index.php
                                                      guarda mensajes en /data
```

| Contenedor   | Imagen               | Función                                         |
|--------------|----------------------|-------------------------------------------------|
| `lishu-nginx`| `nginx:1.27-alpine`  | Servidor web, estáticos y proxy FastCGI a PHP   |
| `lishu-php`  | `php:8.3-fpm-alpine` | Backend: genera el HTML y procesa el formulario |

Ambos están en la red Docker `lishu-net`; nginx encuentra a PHP por el nombre `php`.

## Estructura

```
LISHU-IT-web/
├── docker-compose.yml     # define los 2 servicios y la red
├── nginx/default.conf     # virtual host: root, PHP vía fastcgi_pass, cabeceras de seguridad
├── php/Dockerfile         # imagen PHP-FPM + php.ini propio
├── data/                  # mensajes del formulario (mensajes.csv)
└── src/                   # código de la web (montado en los dos contenedores)
    ├── index.php          # página + lógica del formulario
    ├── includes/datos.php # TODA la info de la empresa (editar aquí)
    ├── includes/funciones.php
    └── assets/            # css e imágenes
```

## Arrancar en local sin instalar nada raro (solo PHP)

```bash
php -S localhost:8000 -t src
```

Abrir <http://localhost:8000>

## Desplegar en cualquier sitio

La web es PHP puro (sin base de datos ni dependencias), así que basta con copiar `src/` como raíz web:

- **Hosting PHP / Apache**: subir el contenido de `src/` a `public_html/` (incluye `.htaccess`).
- **VM Linux (AWS EC2, Azure VM, Proxmox…)**: nginx + php-fpm usando `nginx/default.conf`.
- **Azure App Service / AWS Elastic Beanstalk (PHP)**: desplegar la carpeta `src/`.
- Los mensajes se guardan en `../data/` o en la ruta de la variable de entorno `LISHU_DATA_DIR`.

## Arrancar con Docker (opcional)

Requisito: Docker Desktop instalado y abierto.

```bash
docker compose up -d --build
```

Abrir <http://localhost:8080>

Otros comandos útiles:

```bash
docker compose ps            # ver contenedores
docker compose logs -f       # ver logs
docker compose down          # parar y borrar contenedores
```

## Qué hace PHP

- Pinta todas las secciones recorriendo los arrays de `includes/datos.php`.
- Formulario de contacto con validación en servidor, token CSRF, campo trampa anti-bots,
  escape de salida (`htmlspecialchars`) y patrón POST-Redirect-GET.
- Los mensajes se guardan en `data/mensajes.csv`.
