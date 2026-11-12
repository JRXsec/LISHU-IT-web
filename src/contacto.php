<?php
require __DIR__ . '/includes/layout.php';
require __DIR__ . '/includes/mensajes.php';

// Opciones del desplegable "¿Qué te interesa?"
$intereses = array_merge(
    ['Diagnóstico gratuito'],
    array_column($servicios, 'titulo'),
    array_map(fn($p) => 'Plan ' . $p['nombre'], $planes)
);
$tipos = array_column($clientes, 'titulo');

$errores = [];
$v = ['nombre' => '', 'email' => '', 'empresa' => '', 'tipo' => '', 'interes' => '', 'mensaje' => '', 'privacidad' => ''];

// Si viene desde un plan (servicios.php -> "Lo quiero"), lo preseleccionamos
if (isset($_GET['plan']) && in_array('Plan ' . $_GET['plan'], $intereses, true)) {
    $v['interes'] = 'Plan ' . $_GET['plan'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($v as $campo => $_) {
        $v[$campo] = trim((string)($_POST[$campo] ?? ''));
    }

    if (!csrf_valido()) {
        $errores[] = 'La sesión ha caducado. Vuelve a enviar el formulario.';
    }
    if (!empty($_POST['web'])) { // campo trampa: los humanos no lo ven
        $errores[] = 'Envío no válido.';
    }
    if ($v['nombre'] === '' || largo($v['nombre']) > 80) {
        $errores[] = 'Indica tu nombre (máximo 80 caracteres).';
    }
    if (!filter_var($v['email'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El email no es válido.';
    }
    if (largo($v['empresa']) > 100) {
        $errores[] = 'El nombre de la empresa es demasiado largo.';
    }
    if (!in_array($v['tipo'], $tipos, true)) {
        $errores[] = 'Elige qué tipo de cliente eres.';
    }
    if (!in_array($v['interes'], $intereses, true)) {
        $errores[] = 'Elige qué te interesa.';
    }
    $largo = largo($v['mensaje']);
    if ($largo < 10 || $largo > 2000) {
        $errores[] = 'El mensaje debe tener entre 10 y 2000 caracteres.';
    }
    if ($v['privacidad'] !== 'si') {
        $errores[] = 'Debes aceptar la política de privacidad.';
    }

    if (!$errores) {
        $ok = guardar_mensaje([
            date('Y-m-d H:i:s'), $v['nombre'], $v['email'], $v['empresa'], $v['tipo'], $v['interes'], $v['mensaje'],
        ]);
        if ($ok) {
            unset($_SESSION['csrf']); // token de un solo uso
            $_SESSION['enviado_nombre'] = $v['nombre'];
            header('Location: contacto.php?enviado=1#formulario'); // patrón POST-Redirect-GET
            exit;
        }
        $errores[] = 'No hemos podido guardar tu mensaje. Inténtalo de nuevo o llámanos.';
    }
}

$enviado = isset($_GET['enviado']) && isset($_SESSION['enviado_nombre']);
$nombreEnviado = $enviado ? $_SESSION['enviado_nombre'] : '';
unset($_SESSION['enviado_nombre']);

cabecera('Contacto', 'contacto.php', 'Solicita una auditoría IoT o un diagnóstico gratuito. Te respondemos en menos de 24 horas.');
?>

<section class="cab-pagina" style="--foto: url('<?= e($fotos['contacto']) ?>')">
    <div class="contenedor">
        <p class="eyebrow">// Contacto</p>
        <h1>Hablemos de tus dispositivos</h1>
        <p class="intro">¿Quieres saber cómo de seguros son? Cuéntanos tu caso y te proponemos una auditoría a medida. Respondemos en menos de 24 horas.</p>
    </div>
</section>

<section class="seccion" id="formulario">
    <div class="contenedor contacto-grid">
        <aside class="contacto-info">
            <h2>Datos de contacto</h2>
            <ul class="lista-iconos">
                <li><?= icono('pin') ?><span><strong>Sede central</strong><br><?= e($empresa['direccion']) ?></span></li>
                <li><?= icono('phone') ?><span><strong>Teléfono</strong><br><a href="tel:<?= e(str_replace(' ', '', $empresa['telefono'])) ?>"><?= e($empresa['telefono']) ?></a></span></li>
                <li><?= icono('alert') ?><span><strong>Urgencias 24/7</strong><br><?= e($empresa['urgencias']) ?></span></li>
                <li><?= icono('mail') ?><span><strong>Email</strong><br><a href="mailto:<?= e($empresa['email']) ?>"><?= e($empresa['email']) ?></a></span></li>
                <li><?= icono('clock') ?><span><strong>Horario</strong><br><?= e($empresa['horario']) ?></span></li>
            </ul>
            <div class="movil" aria-hidden="true">
                <div class="movil-cab"><?= icono('shield') ?></div>
                <p>Dispositivos seguros</p>
                <?php foreach (array_slice($dispositivos, 0, 4) as $d): ?>
                    <span><?= e($d) ?> <?= icono('check') ?></span>
                <?php endforeach; ?>
            </div>
        </aside>

        <form class="formulario" method="post" action="contacto.php#formulario" novalidate>
            <h2>Solicita tu auditoría</h2>

            <?php if ($enviado): ?>
                <div class="aviso ok" role="status"><?= icono('check') ?>
                    <span>¡Gracias, <?= e($nombreEnviado) ?>! Hemos recibido tu mensaje. Un técnico te escribirá en menos de 24 horas.</span>
                </div>
            <?php endif; ?>
            <?php if ($errores): ?>
                <div class="aviso error" role="alert">
                    <strong>Revisa el formulario:</strong>
                    <ul><?php foreach ($errores as $err): ?><li><?= e($err) ?></li><?php endforeach; ?></ul>
                </div>
            <?php endif; ?>

            <input type="hidden" name="csrf" value="<?= e(token_csrf()) ?>">
            <div class="trampa" aria-hidden="true"><label>Web <input type="text" name="web" tabindex="-1" autocomplete="off"></label></div>

            <div class="fila-2">
                <label>Nombre *
                    <input type="text" name="nombre" maxlength="80" required autocomplete="name" value="<?= e($v['nombre']) ?>">
                </label>
                <label>Email *
                    <input type="email" name="email" required autocomplete="email" value="<?= e($v['email']) ?>">
                </label>
            </div>
            <label><span>Empresa <small>(opcional)</small></span>
                <input type="text" name="empresa" maxlength="100" autocomplete="organization" value="<?= e($v['empresa']) ?>">
            </label>
            <div class="fila-2">
                <label>Tipo de cliente *
                    <select name="tipo" required>
                        <option value="">Elige una opción…</option>
                        <?php foreach ($tipos as $t): ?>
                            <option<?= $v['tipo'] === $t ? ' selected' : '' ?>><?= e($t) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label>¿Qué te interesa? *
                    <select name="interes" required>
                        <option value="">Elige una opción…</option>
                        <?php foreach ($intereses as $i): ?>
                            <option<?= $v['interes'] === $i ? ' selected' : '' ?>><?= e($i) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </div>
            <label>Mensaje *
                <textarea name="mensaje" rows="5" maxlength="2000" required placeholder="Ej.: tenemos 40 cámaras IP y un sistema de control de accesos en dos edificios…"><?= e($v['mensaje']) ?></textarea>
            </label>
            <label class="check">
                <input type="checkbox" name="privacidad" value="si"<?= $v['privacidad'] === 'si' ? ' checked' : '' ?> required>
                <span>Acepto que LISHU-IT trate mis datos para responder a esta consulta (RGPD).</span>
            </label>
            <button type="submit" class="btn">Enviar solicitud <?= icono('arrow') ?></button>
        </form>
    </div>
</section>

<?php
pie();
