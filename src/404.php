<?php
require_once __DIR__ . '/includes/layout.php';

http_response_code(404);
cabecera('Página no encontrada', '');
?>
<section class="cab-pagina" style="--foto: url('<?= e($fotos['soc']) ?>')">
    <div class="contenedor">
        <p class="eyebrow">// Error 404</p>
        <h1>Esta página no existe… o alguien la ha desconectado</h1>
        <p class="intro">Tranquilo, el resto de la web sigue protegida.</p>
        <div class="hero-cta">
            <a href="index.php" class="btn">Volver al inicio <?= icono('arrow') ?></a>
            <a href="contacto.php" class="btn btn-ghost">Contactar</a>
        </div>
    </div>
</section>
<?php
pie();
