<?php
// Guardado y lectura de los mensajes del formulario de contacto (CSV).
// Carpeta "data" junto a "src", o la ruta de la variable de entorno LISHU_DATA_DIR.
// Así funciona igual en local, Codespaces, Docker, una VM o la nube.

declare(strict_types=1);

function ruta_mensajes(): string
{
    $dir = getenv('LISHU_DATA_DIR') ?: dirname(__DIR__, 2) . '/data';
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }
    return rtrim($dir, '/\\') . '/mensajes.csv';
}

function guardar_mensaje(array $m): bool
{
    $f = @fopen(ruta_mensajes(), 'a');
    if (!$f) {
        return false;
    }
    flock($f, LOCK_EX);
    // Evitar inyección de fórmulas al abrir el CSV en Excel
    $limpio = array_map(fn($v) => preg_match('/^[=+\-@]/', (string)$v) ? "'" . $v : $v, $m);
    $ok = fputcsv($f, $limpio, ',', '"', '\\') !== false;
    flock($f, LOCK_UN);
    fclose($f);
    return $ok;
}

function leer_mensajes(): array
{
    $ruta = ruta_mensajes();
    if (!is_file($ruta)) {
        return [];
    }
    $filas = [];
    $f = fopen($ruta, 'r');
    while (($fila = fgetcsv($f, 0, ',', '"', '\\')) !== false) {
        if (count($fila) >= 7) {
            $filas[] = array_combine(['fecha', 'nombre', 'email', 'empresa', 'tipo', 'interes', 'mensaje'], array_slice($fila, 0, 7));
        }
    }
    fclose($f);
    return array_reverse($filas); // los más recientes primero
}

function token_csrf(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf'];
}

function csrf_valido(): bool
{
    return hash_equals(token_csrf(), (string)($_POST['csrf'] ?? ''));
}
