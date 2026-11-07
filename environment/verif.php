<?php
// Autor: Alfonso Hernández Xochipa
declare(strict_types=1);

const PARCHADAS = ['8.2' => '8.2.35', '8.3' => '8.3.36',
                   '8.4' => '8.4.27', '8.5' => '8.5.12'];
const ESPERADA = '8.5.12';

$r = [];

$rama = PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;
$esperada = version_compare(PHP_VERSION, ESPERADA, '>=');
$r[] = ['PHP',
        $esperada ? PHP_VERSION : PHP_VERSION . ' (esperada ' . ESPERADA . ')',
        $esperada ? 'ok' : 'aviso'];

$min = PARCHADAS[$rama] ?? null;
$r[] = ['Parches 10/2026',
        $min === null ? "rama $rama sin soporte" : "requiere >= $min",
        $min !== null && version_compare(PHP_VERSION, $min, '>=') ? 'ok' : 'falla'];

$r[] = ['CVE-2026-115560',
        'upload_progress ' . (ini_get('session.upload_progress.enabled') ? 'on' : 'off'),
        ini_get('session.upload_progress.enabled') ? 'aviso' : 'ok'];

foreach (['pdo_mysql', 'mysqli', 'mbstring', 'fileinfo', 'zip', 'json'] as $e) {
    $r[] = ["ext $e", extension_loaded($e) ? 'cargada' : 'ausente',
            extension_loaded($e) ? 'ok' : 'falla'];
}

$f85 = function_exists('array_first');
$r[] = ['PHP 8.5', $f85 ? 'array_first disponible' : 'no disponible',
        $f85 ? 'ok' : 'falla'];

$composer = trim((string) @shell_exec('composer --version 2>/dev/null'));
$r[] = ['Composer', $composer !== '' ? $composer : 'sin respuesta',
        $composer !== '' ? 'ok' : 'aviso'];

try {
    $pdo = new PDO(
        sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            getenv('DB_HOST') ?: 'db',
            getenv('DB_PORT') ?: '3306',
            getenv('DB_NAME') ?: 'techstore'),
        getenv('DB_USER') ?: 'techstore',
        getenv('DB_PASSWORD') ?: 'techstore',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $n = (int) $pdo->query('SELECT COUNT(*) FROM productos')->fetchColumn();
    $r[] = ['MySQL', "$n productos", $n > 0 ? 'ok' : 'aviso'];
} catch (PDOException $e) {
    $r[] = ['MySQL', $e->getMessage(), 'falla'];
}

$raiz = $_SERVER['DOCUMENT_ROOT'] ?? '';
$r[] = ['Document root', $raiz, 'ok'];

$fallas = count(array_filter($r, fn(array $x): bool => $x[2] === 'falla'));
$avisos = count(array_filter($r, fn(array $x): bool => $x[2] === 'aviso'));

function h(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Verificación del entorno</title>
<style>
body { font: 14px/1.5 ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
       max-width: 760px; margin: 40px auto; padding: 0 16px; color: #222; }
h1 { font-size: 16px; font-weight: 600; margin: 0 0 4px; }
p.sub { color: #777; margin: 0 0 24px; }
table { width: 100%; border-collapse: collapse; }
td { padding: 6px 8px 6px 0; border-bottom: 1px solid #eee; vertical-align: top; }
td.k { width: 170px; color: #555; }
td.s { width: 60px; }
.ok { color: #2a7d3f; }
.aviso { color: #b06c00; }
.falla { color: #b3261e; }
p.tot { margin-top: 24px; color: #555; }
</style>
</head>
<body>
<h1>Verificación del entorno</h1>
<p class="sub">Módulo 8 · Desarrollo backend con PHP</p>

<table>
<?php foreach ($r as [$clave, $detalle, $estado]): ?>
  <tr>
    <td class="k"><?= h($clave) ?></td>
    <td class="s <?= $estado ?>"><?= $estado ?></td>
    <td><?= h($detalle) ?></td>
  </tr>
<?php endforeach; ?>
</table>

<p class="tot">
<?php if ($fallas === 0 && $avisos === 0): ?>
  Sin fallas.
<?php else: ?>
  <?= $fallas ?> falla(s), <?= $avisos ?> aviso(s).
<?php endif; ?>
</p>
</body>
</html>
