<?php
require __DIR__ . '/includes/layout.php';

$anios = (int)date('Y') - $empresa['fundacion'];
cabecera('Nosotros', 'nosotros.php', $empresa['resumen']);
?>

<section class="cab-pagina" style="--foto: url('<?= e($fotos['equipo']) ?>')">
    <div class="contenedor">
        <p class="eyebrow">// Quiénes somos</p>
        <h1><?= $anios ?> años protegiendo lo que está conectado</h1>
        <p class="intro"><?= e($empresa['resumen']) ?></p>
    </div>
</section>

<section class="seccion">
    <div class="contenedor grid-2 centrado">
        <div>
            <h2><span class="num">01</span> Quiénes somos</h2>
            <p class="parrafo"><?= e($empresa['intro']) ?></p>
            <p class="parrafo">Nacimos en <?= (int)$empresa['fundacion'] ?> diseñando redes de sensores para la industria, así que conocemos los dispositivos IoT por dentro: cómo se fabrican, cómo se comunican y cómo se rompen. Hoy somos una multinacional con proyectos privados y públicos, pero seguimos trabajando como el primer día: con un técnico de referencia para cada cliente.</p>
            <div class="sellos">
                <div class="sello"><strong>+<?= intdiv($anios, 5) * 5 ?></strong><span>años de experiencia</span></div>
                <div class="sello"><strong>I+D</strong><span>departamento propio</span></div>
            </div>
        </div>
        <figure class="foto-marco revelar">
            <img src="<?= e($fotos['oficina']) ?>" alt="Oficinas centrales de LISHU-IT en Madrid" loading="lazy">
            <figcaption><?= icono('pin') ?> Sede central · Madrid</figcaption>
        </figure>
    </div>
</section>

<section class="seccion seccion-alt">
    <div class="contenedor">
        <h2><span class="num">02</span> Nuestra historia</h2>
        <ol class="linea-tiempo">
            <?php foreach ($historia as $h): ?>
                <li class="revelar"><span class="anio"><?= e($h['anio']) ?></span><p><?= e($h['texto']) ?></p></li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<section class="seccion">
    <div class="contenedor">
        <h2><span class="num">03</span> Nuestros valores</h2>
        <div class="grid-4">
            <?php foreach ($valores as $v): ?>
                <article class="tarjeta revelar">
                    <div class="tarjeta-tit"><?= icono($v['icono']) ?><h3><?= e($v['titulo']) ?></h3></div>
                    <p><?= e($v['texto']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="seccion seccion-alt">
    <div class="contenedor">
        <h2><span class="num">04</span> Dirección</h2>
        <div class="grid-4">
            <?php foreach ($equipo as $p): ?>
                <article class="persona revelar">
                    <img src="<?= e($p['foto']) ?>" alt="<?= e($p['nombre']) ?>" loading="lazy">
                    <h3><?= e($p['nombre']) ?></h3>
                    <p><?= e($p['cargo']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="seccion">
    <div class="contenedor grid-2">
        <div>
            <h2><span class="num">05</span> De España al mundo</h2>
            <p class="parrafo">Referencia en seguridad IoT en España y en plena expansión internacional.</p>
            <ul class="oficinas">
                <?php foreach ($oficinas as $o): ?>
                    <li><?= icono('pin') ?><span><strong><?= e($o['ciudad']) ?></strong> · <?= e($o['pais']) ?><small><?= e($o['tipo']) ?></small></span></li>
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
            <h2 class="mt"><span class="num">07</span> Canales</h2>
            <ul class="lista-iconos">
                <?php foreach ($canales as $c): ?>
                    <li><?= icono($c['icono']) ?><span><strong><?= e($c['titulo']) ?>:</strong> <?= e($c['texto']) ?></span></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

<section class="seccion seccion-alt">
    <div class="contenedor">
        <p class="ventaja grande"><strong>Ventaja competitiva:</strong> <?= e($empresa['ventaja']) ?></p>
    </div>
</section>

<?php
cta('¿Quieres trabajar con nosotros?', 'Buscamos clientes exigentes… y también talento. Escríbenos.');
pie();
