<?php
require __DIR__ . '/includes/layout.php';

cabecera('Servicios', 'servicios.php', 'Auditoría IoT, pentesting, evaluación de riesgos, monitorización 24/7, mantenimiento y certificación de producto.');
?>

<section class="cab-pagina" style="--foto: url('<?= e($fotos['soc']) ?>')">
    <div class="contenedor">
        <p class="eyebrow">// Servicios</p>
        <h1>Seguridad de principio a fin para tus dispositivos conectados</h1>
        <p class="intro">Del primer inventario al mantenimiento diario: un único equipo especializado en IoT que se encarga de todo.</p>
    </div>
</section>

<section class="seccion">
    <div class="contenedor">
        <h2><span class="num">01</span> Qué hacemos</h2>
        <div class="grid-3">
            <?php foreach ($servicios as $s): ?>
                <article class="tarjeta servicio revelar">
                    <span class="icono-caja"><?= icono($s['icono']) ?></span>
                    <h3><?= e($s['titulo']) ?></h3>
                    <p><?= e($s['texto']) ?></p>
                    <ul>
                        <?php foreach ($s['incluye'] as $item): ?>
                            <li><?= icono('check') ?><?= e($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="seccion seccion-alt">
    <div class="contenedor">
        <h2><span class="num">02</span> Nuestro método en 5 pasos</h2>
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

<section class="seccion" id="planes">
    <div class="contenedor">
        <h2><span class="num">03</span> Planes</h2>
        <p class="subtitulo">Precios orientativos sin IVA. La primera revisión es siempre gratuita.</p>
        <div class="grid-3 planes">
            <?php foreach ($planes as $p): ?>
                <article class="plan<?= $p['destacado'] ? ' plan-destacado' : '' ?>">
                    <?php if ($p['destacado']): ?><span class="etiqueta">Más elegido</span><?php endif; ?>
                    <h3><?= e($p['nombre']) ?></h3>
                    <p class="plan-para"><?= e($p['para']) ?></p>
                    <p class="precio"><strong><?= e($p['precio']) ?></strong> <?= e($p['periodo']) ?></p>
                    <ul>
                        <?php foreach ($p['items'] as $item): ?>
                            <li><?= icono('check') ?><?= e($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="contacto.php?plan=<?= urlencode($p['nombre']) ?>" class="btn<?= $p['destacado'] ? '' : ' btn-borde' ?>">Lo quiero</a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="seccion seccion-alt">
    <div class="contenedor">
        <h2><span class="num">04</span> Normas y certificaciones</h2>
        <div class="normas">
            <?php foreach ($normas as $n): ?>
                <span><?= icono('award') ?><?= e($n) ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="seccion" id="faq">
    <div class="contenedor estrecho">
        <h2><span class="num">05</span> Preguntas frecuentes</h2>
        <div class="faq">
            <?php foreach ($faq as $i => $f): ?>
                <details<?= $i === 0 ? ' open' : '' ?>>
                    <summary><?= e($f['p']) ?></summary>
                    <p><?= e($f['r']) ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
cta();
pie();
