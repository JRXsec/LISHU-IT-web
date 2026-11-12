<?php
// Panel interno: lista los mensajes recibidos por el formulario de contacto.
// Contraseña: variable de entorno LISHU_ADMIN_PASS (por defecto "lishu2026", solo para la demo).
require __DIR__ . '/includes/layout.php';
require __DIR__ . '/includes/mensajes.php';

$clave = getenv('LISHU_ADMIN_PASS') ?: 'lishu2026';
$error = '';

if (isset($_GET['salir'])) {
    unset($_SESSION['admin']);
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (csrf_valido() && hash_equals($clave, (string)($_POST['clave'] ?? ''))) {
        session_regenerate_id(true);
        $_SESSION['admin'] = true;
        header('Location: admin.php');
        exit;
    }
    usleep(500000); // frena ataques de fuerza bruta
    $error = 'Contraseña incorrecta.';
}

$logueado = !empty($_SESSION['admin']);
$mensajes = $logueado ? leer_mensajes() : [];

header('X-Robots-Tag: noindex');
cabecera('Panel interno', '', 'Panel interno de LISHU-IT');
?>

<section class="seccion admin">
    <div class="contenedor">
        <?php if (!$logueado): ?>
            <form class="formulario login" method="post" action="admin.php">
                <h2><?= icono('lock') ?> Panel interno</h2>
                <p class="subtitulo">Acceso solo para el equipo de LISHU-IT.</p>
                <?php if ($error): ?><div class="aviso error" role="alert"><?= e($error) ?></div><?php endif; ?>
                <input type="hidden" name="csrf" value="<?= e(token_csrf()) ?>">
                <label>Contraseña
                    <input type="password" name="clave" required autocomplete="current-password" autofocus>
                </label>
                <button class="btn" type="submit">Entrar</button>
            </form>
        <?php else: ?>
            <div class="seccion-cab">
                <h2><?= icono('mail') ?> Mensajes recibidos <span class="contador"><?= count($mensajes) ?></span></h2>
                <a class="enlace" href="admin.php?salir=1"><?= icono('logout') ?> Cerrar sesión</a>
            </div>
            <?php if (!$mensajes): ?>
                <p class="vacio">Todavía no hay mensajes. Prueba a enviar uno desde <a href="contacto.php">Contacto</a>.</p>
            <?php else: ?>
                <div class="tabla-wrap">
                    <table class="tabla">
                        <thead><tr><th>Fecha</th><th>Contacto</th><th>Tipo / interés</th><th>Mensaje</th></tr></thead>
                        <tbody>
                        <?php foreach ($mensajes as $m): ?>
                            <tr>
                                <td class="nowrap"><?= e($m['fecha']) ?></td>
                                <td><strong><?= e($m['nombre']) ?></strong><br><a href="mailto:<?= e($m['email']) ?>"><?= e($m['email']) ?></a><?= $m['empresa'] !== '' ? '<br><small>' . e($m['empresa']) . '</small>' : '' ?></td>
                                <td><?= e($m['tipo']) ?><br><small><?= e($m['interes']) ?></small></td>
                                <td class="msg"><?= nl2br(e($m['mensaje'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php
pie();
