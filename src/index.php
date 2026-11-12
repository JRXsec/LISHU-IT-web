<?php
declare(strict_types=1);
session_start();

require __DIR__ . '/includes/datos.php';
require __DIR__ . '/includes/funciones.php';

// ---------- Formulario de contacto (procesado por PHP en el backend) ----------
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
}

$errores = [];
$valores = ['nombre' => '', 'email' => '', 'tipo' => '', 'mensaje' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($valores as $campo => $_) {
        $valores[$campo] = trim((string)($_POST[$campo] ?? ''));
    }

    if (!hash_equals($_SESSION['csrf'], (string)($_POST['csrf'] ?? ''))) {
        $errores[] = 'La sesión ha caducado, vuelve a enviar el formulario.';
    }
    if (!empty($_POST['web'])) { // campo trampa anti-bots
        $errores[] = 'Envío no válido.';
    }
    if ($valores['nombre'] === '' || mb_strlen($valores['nombre']) > 80) {
        $errores[] = 'Indica tu nombre.';
    }
    if (!filter_var($valores['email'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El email no es válido.';
    }
    $tiposValidos = array_column($clientes, 'titulo');
    if (!in_array($valores['tipo'], $tiposValidos, true)) {
        $errores[] = 'Elige qué tipo de cliente eres.';
    }
    if (mb_strlen($valores['mensaje']) < 10 || mb_strlen($valores['mensaje']) > 2000) {
        $errores[] = 'El mensaje debe tener entre 10 y 2000 caracteres.';
    }

    if (!$errores) {
        // Carpeta "data" junto a "src": funciona igual en Docker, VM, hosting o nube
        $dirDatos = getenv('LISHU_DATA_DIR') ?: dirname(__DIR__) . '/data';
        if (!is_dir($dirDatos)) {
            @mkdir($dirDatos, 0775, true);
        }
        $f = @fopen($dirDatos . '/mensajes.csv', 'a');
        if ($f) {
            fputcsv($f, [date('Y-m-d H:i:s'), $valores['nombre'], $valores['email'], $valores['tipo'], $valores['mensaje']]);
            fclose($f);
            $_SESSION['csrf'] = bin2hex(random_bytes(16));
            header('Location: /?enviado=1#contacto'); // patrón POST-Redirect-GET
            exit;
        }
        $errores[] = 'No se ha podido guardar el mensaje. Inténtalo más tarde.';
    }
}
$enviado = isset($_GET['enviado']);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($empresa['nombre']) ?> · Ciberseguridad IoT</title>
    <meta name="description" content="<?= e($empresa['intro']) ?>">
    <link rel="icon" href="/assets/img/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<header class="nav">
    <div class="contenedor nav-in">
        <a href="#inicio" class="logo">LISHU<span>-</span>IT</a>
        <input type="checkbox" id="menu-toggle" hidden>
        <label for="menu-toggle" class="menu-btn" aria-label="Abrir menú"><span></span><span></span><span></span></label>
        <nav class="menu">
            <a href="#propuesta">Propuesta</a>
            <a href="#clientes">Clientes</a>
            <a href="#metodo">Cómo trabajamos</a>
            <a href="#competencia">Competencia</a>
            <a href="#alianzas">Alianzas</a>
            <a href="#contacto" class="btn btn-sm">Contacto</a>
        </nav>
    </div>
</header>

<!-- ============ HERO ============ -->
<section class="hero" id="inicio">
    <div class="contenedor hero-in">
        <div>
            <p class="eyebrow">// Ciberseguridad · Auditoría IoT</p>
            <h1>LISHU<span>-</span>IT</h1>
            <p class="lema"><?= e($empresa['lema']) ?></p>
            <p class="intro"><?= e($empresa['intro']) ?></p>
            <div class="hero-cta">
                <a href="#contacto" class="btn">Solicitar auditoría</a>
                <a href="#metodo" class="btn btn-ghost">Cómo trabajamos</a>
            </div>
        </div>
        <div class="radar" aria-hidden="true">
            <div class="radar-centro"><?= icono('shield') ?></div>
            <?php
            $nodos = [['camera', 'cámaras'], ['bulb', 'iluminación'], ['wifi', 'sensores'], ['clock', 'climatización'], ['home', 'hogar'], ['building', 'edificios']];
            foreach ($nodos as $i => [$ic, $txt]): ?>
                <div class="nodo n<?= $i ?>"><span><?= icono($ic) ?></span><small><?= e($txt) ?></small></div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="cifras">
        <div class="contenedor cifras-in">
            <?php foreach ($cifras as $c): ?>
                <div class="cifra">
                    <strong><?= e($c['titulo']) ?></strong>
                    <span><?= e($c['texto']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<main>
    <!-- ============ 01 PROPUESTA ============ -->
    <section class="seccion" id="propuesta">
        <div class="contenedor propuesta">
            <div>
                <h2><span class="num">01</span> Propuesta de valor</h2>
                <p class="destacado">Que los dispositivos conectados funcionen de forma
                    <em>segura, privada y continua</em> con auditoría, mantenimiento y soluciones avanzadas.</p>
            </div>
            <div class="grid-3">
                <?php foreach ($propuesta as $p): ?>
                    <article class="tarjeta">
                        <div class="tarjeta-tit"><?= icono($p['icono']) ?><h3><?= e($p['titulo']) ?></h3></div>
                        <p><?= e($p['texto']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ 02 CLIENTES ============ -->
    <section class="seccion seccion-alt" id="clientes">
        <div class="contenedor">
            <h2><span class="num">02</span> A quién protegemos</h2>
            <div class="grid-5">
                <?php foreach ($clientes as $c): ?>
                    <article class="tarjeta tarjeta-borde">
                        <?= icono($c['icono']) ?>
                        <h3><?= e($c['titulo']) ?></h3>
                        <p><?= e($c['texto']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ============ 03 MÉTODO ============ -->
    <section class="seccion" id="metodo">
        <div class="contenedor">
            <h2><span class="num">03</span> Cómo trabajamos</h2>
            <ol class="proceso">
                <?php foreach ($proceso as $i => $paso): ?>
                    <li class="paso<?= $i === count($proceso) - 1 ? ' paso-final' : '' ?>">
                        <span class="paso-num"><?= sprintf('%02d', $i + 1) ?></span>
                        <h3><?= e($paso['titulo']) ?></h3>
                        <p><?= e($paso['texto']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>

    <!-- ============ 04 COMPETENCIA ============ -->
    <section class="seccion seccion-alt" id="competencia">
        <div class="contenedor">
            <h2><span class="num">04</span> Frente a la competencia</h2>
            <div class="tabla-wrap">
                <table class="tabla">
                    <thead>
                    <tr><th>Competidor</th><th>Su enfoque</th><th>LISHU-IT</th></tr>
                    </thead>
                    <tbody>
                    <?php foreach ($competencia as $c): ?>
                        <tr>
                            <td><strong><?= e($c['nombre']) ?></strong></td>
                            <td><?= e($c['enfoque']) ?></td>
                            <td class="nos"><?= icono('check') ?><?= e($c['nosotros']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <p class="ventaja"><strong>Ventaja competitiva:</strong> I+D propio y atención personalizada y cercana frente a grandes generalistas.</p>
        </div>
    </section>

    <!-- ============ 05 CANALES Y ALIANZAS ============ -->
    <section class="seccion" id="alianzas">
        <div class="contenedor grid-2">
            <div>
                <h2><span class="num">05</span> Canales</h2>
                <ul class="lista-iconos">
                    <?php foreach ($canales as $c): ?>
                        <li><?= icono($c['icono']) ?><span><strong><?= e($c['titulo']) ?>:</strong> <?= e($c['texto']) ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div>
                <h2><span class="num">06</span> Alianzas clave</h2>
                <div class="grid-2 alianzas">
                    <?php foreach ($alianzas as $a): ?>
                        <article class="alianza">
                            <span class="circulo"><?= icono($a['icono']) ?></span>
                            <div><h3><?= e($a['titulo']) ?></h3><p><?= e($a['texto']) ?></p></div>
                        </article>
                    <?php endforeach; ?>
                </div>
                <div class="mundo">
                    <?= icono('globe') ?>
                    <p><strong>De España al mundo.</strong> Referencia en seguridad IoT en España y expansión internacional.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ CONTACTO ============ -->
    <section class="seccion seccion-oscura" id="contacto">
        <div class="contenedor grid-2">
            <div>
                <h2><span class="num">07</span> Hablemos</h2>
                <p class="intro">¿Quieres saber cómo de seguros son tus dispositivos conectados? Cuéntanos tu caso y te proponemos una auditoría a medida.</p>
                <ul class="lista-iconos">
                    <li><?= icono('mail') ?><span><?= e($empresa['email']) ?></span></li>
                    <li><?= icono('phone') ?><span><?= e($empresa['telefono']) ?></span></li>
                </ul>
                <div class="checklist">
                    <p>Dispositivos seguros</p>
                    <?php foreach ($dispositivos as $d): ?>
                        <span><?= e($d) ?> <?= icono('check') ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <form class="formulario" method="post" action="/#contacto" novalidate>
                <?php if ($enviado): ?>
                    <div class="aviso ok"><?= icono('check') ?> ¡Gracias! Hemos recibido tu mensaje y te responderemos pronto.</div>
                <?php endif; ?>
                <?php if ($errores): ?>
                    <div class="aviso error">
                        <?php foreach ($errores as $err): ?><p><?= e($err) ?></p><?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
                <input type="text" name="web" class="trampa" tabindex="-1" autocomplete="off" aria-hidden="true">

                <label>Nombre
                    <input type="text" name="nombre" maxlength="80" required value="<?= e($valores['nombre']) ?>">
                </label>
                <label>Email
                    <input type="email" name="email" required value="<?= e($valores['email']) ?>">
                </label>
                <label>Tipo de cliente
                    <select name="tipo" required>
                        <option value="">Elige una opción…</option>
                        <?php foreach ($clientes as $c): ?>
                            <option <?= $valores['tipo'] === $c['titulo'] ? 'selected' : '' ?>><?= e($c['titulo']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label>Mensaje
                    <textarea name="mensaje" rows="5" maxlength="2000" required><?= e($valores['mensaje']) ?></textarea>
                </label>
                <button type="submit" class="btn">Enviar mensaje</button>
            </form>
        </div>
    </section>
</main>

<footer class="pie">
    <div class="contenedor pie-in">
        <span class="logo">LISHU<span>-</span>IT</span>
        <p>Objetivo: <em><?= e($empresa['objetivo']) ?></em></p>
    </div>
    <div class="contenedor pie-tec">
        <small>&copy; <?= date('Y') ?> <?= e($empresa['nombre']) ?> · Empresa ficticia (proyecto de fin de curso) ·
            Servido con nginx + PHP <?= e(PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION) ?> en Docker</small>
    </div>
</footer>

</body>
</html>
