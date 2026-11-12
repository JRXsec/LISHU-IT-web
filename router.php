<?php
// Router para el servidor de desarrollo de PHP:
//     php -S localhost:8000 -t src router.php
// Hace lo mismo que nginx/default.conf y src/.htaccess:
// bloquea /includes y ficheros ocultos y añade cabeceras de seguridad.

$ruta = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');

if (preg_match('#^/(includes|data)(/|$)#', $ruta) || preg_match('#/\.#', $ruta)) {
    http_response_code(404);
    echo '404 - No encontrado';
    return true;
}

header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');

$fichero = __DIR__ . '/src' . $ruta;
if ($ruta !== '/' && is_file($fichero) && !str_ends_with($ruta, '.php')) {
    return false; // estático (css, js, svg…): lo sirve PHP directamente
}
if ($ruta === '/' || is_file($fichero)) {
    return false; // página .php existente
}

http_response_code(404);
$_GET['ruta'] = $ruta;
require __DIR__ . '/src/404.php';
