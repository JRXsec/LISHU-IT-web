<?php
require __DIR__ . '/includes/layout.php';

cabecera('Ciberseguridad IoT', 'index.php');
?>

<!-- ============ HERO ============ -->
<section class="hero" style="--foto: url('<?= e($fotos['hero']) ?>')">
    <div class="contenedor hero-in">
        <div>
            <p class="eyebrow">// Ciberseguridad · Auditoría IoT</p>
            <h1>LISHU<span>-</span>IT</h1>
            <p class="lema"><?= e($empresa['lema']) ?></p>
            <p class="intro"><?= e($empresa['intro']) ?></p>
            <div class="hero-cta">
                <a href="contacto.php" class="btn">Solicitar auditoría <?= icono('arrow') ?></a>
                <a href="servicios.php" class="btn btn-ghost">Ver servicios</a>
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
                <article class="tarjeta revelar">
                    <div class="tarjeta-tit"><?= icono($p['icono']) ?><h3><?= e($p['titulo']) ?></h3></div>
                    <p><?= e($p['texto']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ NÚMEROS ============ -->
<section class="numeros">
    <div class="contenedor numeros-in">
        <?php foreach ($numeros as $n): ?>
            <div class="numero">
                <strong data-contador="<?= (int)$n['valor'] ?>" data-sufijo="<?= e($n['sufijo']) ?>"><?= e(number_format($n['valor'], 0, ',', '.') . $n['sufijo']) ?></strong>
                <span><?= e($n['texto']) ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ============ 02 CLIENTES ============ -->
<section class="seccion seccion-alt" id="clientes">
    <div class="contenedor">
        <div class="seccion-cab">
            <h2><span class="num">02</span> A quién protegemos</h2>
            <a href="sectores.php" class="enlace">Ver todos los sectores <?= icono('arrow') ?></a>
        </div>
        <div class="grid-5">
            <?php foreach ($clientes as $c): ?>
                <a class="sector revelar" href="sectores.php#<?= e($c['id']) ?>">
                    <div class="sector-foto"><img src="<?= e(str_replace('w=1200', 'w=500', $c['foto'])) ?>" alt="" loading="lazy"></div>
                    <div class="sector-txt">
                        <?= icono($c['icono']) ?>
                        <h3><?= e($c['titulo']) ?></h3>
                        <p><?= e($c['texto']) ?></p>
                    </div>
                </a>
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

<!-- ============ POR QUÉ + FOTO ============ -->
<section class="seccion seccion-alt">
    <div class="contenedor grid-2 centrado">
        <figure class="foto-marco revelar">
            <img src="<?= e($fotos['lab']) ?>" alt="Ingeniera del laboratorio de I+D de LISHU-IT analizando un dispositivo" loading="lazy">
            <figcaption><?= icono('flask') ?> Laboratorio de I+D · Tres Cantos</figcaption>
        </figure>
        <div>
            <h2><span class="num">04</span> ¿Por qué LISHU-IT?</h2>
            <ul class="checks">
                <?php foreach ($porque as $p): ?>
                    <li><?= icono('check') ?><span><strong><?= e($p['fuerte']) ?></strong><?= e($p['resto']) ?></span></li>
                <?php endforeach; ?>
            </ul>
            <p class="pastilla">Auditoría · Monitorización · Mantenimiento</p>
        </div>
    </div>
</section>

<!-- ============ TESTIMONIOS ============ -->
<section class="seccion">
    <div class="contenedor">
        <h2><span class="num">05</span> Lo que dicen nuestros clientes</h2>
        <div class="grid-3">
            <?php foreach ($testimonios as $t): ?>
                <blockquote class="testimonio revelar">
                    <?= icono('quote') ?>
                    <p><?= e($t['texto']) ?></p>
                    <footer>
                        <img src="<?= e($t['foto']) ?>" alt="" loading="lazy">
                        <span><strong><?= e($t['nombre']) ?></strong><small><?= e($t['cargo']) ?></small></span>
                    </footer>
                </blockquote>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ COMPETENCIA ============ -->
<section class="seccion seccion-alt" id="competencia">
    <div class="contenedor">
        <h2><span class="num">06</span> Frente a la competencia</h2>
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
        <p class="ventaja"><strong>Ventaja competitiva:</strong> <?= e($empresa['ventaja']) ?></p>
    </div>
</section>

<!-- ============ CANALES Y ALIANZAS ============ -->
<section class="seccion" id="alianzas">
    <div class="contenedor grid-2">
        <div>
            <h2><span class="num">07</span> Canales</h2>
            <ul class="lista-iconos">
                <?php foreach ($canales as $c): ?>
                    <li><?= icono($c['icono']) ?><span><strong><?= e($c['titulo']) ?>:</strong> <?= e($c['texto']) ?></span></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div>
            <h2><span class="num">08</span> Alianzas clave</h2>
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

<?php
cta();
pie();
