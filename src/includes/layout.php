<?php
// Cabecera y pie comunes a todas las páginas.
// Uso:  cabecera('Título', 'servicios.php');  ...contenido...  pie();

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}

require_once __DIR__ . '/datos.php';
require_once __DIR__ . '/funciones.php';

function cabecera(string $titulo, string $activa, string $descripcion = ''): void
{
    global $empresa, $menu;
    $descripcion = $descripcion ?: $empresa['intro'];
    ?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($titulo) ?> · <?= e($empresa['nombre']) ?></title>
    <meta name="description" content="<?= e($descripcion) ?>">
    <meta property="og:title" content="<?= e($empresa['nombre'] . ' · ' . $titulo) ?>">
    <meta property="og:description" content="<?= e($descripcion) ?>">
    <meta name="theme-color" content="#0b1626">
    <link rel="icon" href="assets/img/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js" defer></script>
</head>
<body>
<a class="saltar" href="#contenido">Saltar al contenido</a>
<header class="nav">
    <div class="contenedor nav-in">
        <a href="index.php" class="logo" aria-label="LISHU-IT, inicio"><?= icono('shield') ?><b>LISHU<span>-</span>IT</b></a>
        <input type="checkbox" id="menu-toggle" hidden>
        <label for="menu-toggle" class="menu-btn" aria-label="Abrir menú"><span></span><span></span><span></span></label>
        <nav class="menu" aria-label="Principal">
            <?php foreach ($menu as $url => $texto): ?>
                <a href="<?= e($url) ?>"<?= $url === $activa ? ' class="activo" aria-current="page"' : '' ?>><?= e($texto) ?></a>
            <?php endforeach; ?>
            <a href="contacto.php" class="btn btn-sm">Solicitar auditoría</a>
        </nav>
    </div>
</header>
<main id="contenido">
<?php
}

function pie(): void
{
    global $empresa, $menu, $clientes;
    ?>
</main>

<footer class="pie">
    <div class="contenedor pie-grid">
        <div>
            <a href="index.php" class="logo"><?= icono('shield') ?><b>LISHU<span>-</span>IT</b></a>
            <p class="pie-lema"><?= e($empresa['lema']) ?></p>
            <p class="pie-obj">Objetivo: <em><?= e($empresa['objetivo']) ?></em></p>
            <div class="redes">
                <a href="<?= e($empresa['linkedin']) ?>" aria-label="LinkedIn" target="_blank" rel="noopener"><?= icono('linkedin') ?></a>
                <a href="mailto:<?= e($empresa['email']) ?>" aria-label="Email"><?= icono('mail') ?></a>
                <a href="index.php" aria-label="Web"><?= icono('globe') ?></a>
            </div>
        </div>
        <div>
            <h4>Empresa</h4>
            <?php foreach ($menu as $url => $texto): ?>
                <a href="<?= e($url) ?>"><?= e($texto) ?></a>
            <?php endforeach; ?>
        </div>
        <div>
            <h4>Sectores</h4>
            <?php foreach ($clientes as $c): ?>
                <a href="sectores.php#<?= e($c['id']) ?>"><?= e($c['titulo']) ?></a>
            <?php endforeach; ?>
        </div>
        <div>
            <h4>Contacto</h4>
            <p><?= e($empresa['direccion']) ?></p>
            <p><a href="tel:<?= e(str_replace(' ', '', $empresa['telefono'])) ?>"><?= e($empresa['telefono']) ?></a></p>
            <p><a href="mailto:<?= e($empresa['email']) ?>"><?= e($empresa['email']) ?></a></p>
            <p class="urgencias"><?= icono('alert') ?> Urgencias 24/7: <?= e($empresa['urgencias']) ?></p>
        </div>
    </div>
    <div class="contenedor pie-tec">
        <small>&copy; <?= date('Y') ?> <?= e($empresa['nombre']) ?> · Empresa ficticia creada para un proyecto de fin de curso · Fotos: Unsplash</small>
        <small>Servido por PHP <?= e(PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION) ?> · <?= e(php_sapi_name() === 'cli-server' ? 'servidor de desarrollo' : ($_SERVER['SERVER_SOFTWARE'] ?? 'servidor web')) ?></small>
    </div>
</footer>
</body>
</html>
<?php
}

// Bloque reutilizable: llamada a la acción final
function cta(string $titulo = '¿Cómo de seguros son tus dispositivos?', string $texto = 'Te hacemos un diagnóstico inicial gratuito y sin compromiso en menos de 48 horas.'): void
{
    ?>
    <section class="cta">
        <div class="contenedor cta-in">
            <div>
                <h2><?= e($titulo) ?></h2>
                <p><?= e($texto) ?></p>
            </div>
            <a href="contacto.php" class="btn btn-claro">Pedir diagnóstico gratis <?= icono('arrow') ?></a>
        </div>
    </section>
    <?php
}
