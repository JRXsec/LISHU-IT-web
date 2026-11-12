<?php
require __DIR__ . '/includes/layout.php';

cabecera('Sectores', 'sectores.php', 'Protegemos a grandes empresas e industria, tecnológicas y domótica, hoteles y edificios, pymes y particulares.');
?>

<section class="cab-pagina" style="--foto: url('<?= e($fotos['oficina']) ?>')">
    <div class="contenedor">
        <p class="eyebrow">// A quién protegemos</p>
        <h1>Del hogar a la fábrica: cada entorno conectado tiene sus riesgos</h1>
        <p class="intro">Adaptamos la auditoría y la protección al tamaño, al sector y al nivel de riesgo de cada cliente.</p>
        <nav class="chips" aria-label="Sectores">
            <?php foreach ($clientes as $c): ?>
                <a href="#<?= e($c['id']) ?>"><?= icono($c['icono']) ?><?= e($c['titulo']) ?></a>
            <?php endforeach; ?>
        </nav>
    </div>
</section>

<?php foreach ($clientes as $i => $c): ?>
<section class="seccion<?= $i % 2 ? ' seccion-alt' : '' ?>" id="<?= e($c['id']) ?>">
    <div class="contenedor grid-2 centrado sector-detalle<?= $i % 2 ? ' invertido' : '' ?>">
        <figure class="foto-marco revelar">
            <img src="<?= e($c['foto']) ?>" alt="<?= e($c['titulo']) ?>" loading="lazy">
        </figure>
        <div>
            <p class="eyebrow oscuro"><?= icono($c['icono']) ?> <?= e($c['texto']) ?></p>
            <h2><?= e($c['titulo']) ?></h2>
            <p class="parrafo"><?= e($c['detalle']) ?></p>
            <h3 class="mini">Riesgos más habituales</h3>
            <ul class="riesgos">
                <?php foreach ($c['riesgos'] as $r): ?>
                    <li><?= icono('alert') ?><?= e($r) ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="caso">
                <p class="caso-tit"><?= icono('award') ?> Caso de éxito · <?= e($c['caso']['cliente']) ?></p>
                <p><?= e($c['caso']['resultado']) ?></p>
            </div>
        </div>
    </div>
</section>
<?php endforeach; ?>

<?php
cta('¿Tu sector no aparece?', 'Si tiene algo conectado, podemos protegerlo. Cuéntanos tu caso.');
pie();
