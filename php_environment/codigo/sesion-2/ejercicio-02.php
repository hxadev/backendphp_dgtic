<?php
// Autor: Alfonso Hernández Xochipa
// Ejercicio 2 — El catálogo y su representación
//
// Integrantes: ___________________________  ___________________________
//
// Comprobaciones:  docker compose exec web php codigo/sesion-2/ejercicio-02.php
// Página:          http://localhost:8080/codigo/sesion-2/ejercicio-02.php
// JSON:            http://localhost:8080/codigo/sesion-2/ejercicio-02.php?formato=json
//
// ESTE ARCHIVO TIENE DOS MITADES, Y LA FRONTERA IMPORTA:
//
//   EL MODELO (partes 1 a 2)  no imprime nada, no conoce HTTP, no sabe
//                             si el resultado va a ser HTML o JSON.
//   LA PRESENTACIÓN (parte 3) decide el formato y lo escribe.
//
// Si en las partes 1 a 2 escriben un echo, rompieron la regla.
declare(strict_types=1);

$cursos     = require __DIR__ . '/../datos/cursos.php';
$categorias = require __DIR__ . '/../datos/categorias.php';
$niveles    = require __DIR__ . '/../datos/niveles.php';

// =====================================================================
// MODELO — PARTE 1: qué se ve
// =====================================================================
// Devuelve los cursos ACTIVOS. Si se pasa $categoriaId, además filtra
// por esa categoría.
//
//   cursosVisibles($cursos)      -> 11 cursos (el 12 está inactivo)
//   cursosVisibles($cursos, 2)   -> los de Bases de Datos: ids 2 y 3
//   cursosVisibles($cursos, 99)  -> []
//
// Las claves del resultado van 0, 1, 2… sin huecos. Si no, la parte 4
// va a producir un objeto JSON en lugar de un arreglo.

function cursosVisibles(array $cursos, ?int $categoriaId = null): array
{
    // TODO
     // id:5, id:10
    //array_values(array_filter());//0....n
    return [];
}


// =====================================================================
// MODELO — PARTE 2: cómo se ve hacia afuera (4 puntos)
// =====================================================================
// Traduce UN curso de la forma en que lo guardamos a la forma que el
// frontend espera. Son dos lenguajes distintos:
//
//   nosotros guardamos   level_id, category_id, created_at   (snake_case)
//   el frontend espera   levelId,  categoryId,  createdAt    (camelCase)
//
// Devuelve EXACTAMENTE estas claves, en este orden:
//
//   id, title, description, price, duration, active,
//   createdAt, updatedAt, ranking, levelId, categoryId
//
// Los tipos importan: price es float, duration e id son int, active es
// bool. Si llegan como cadena, conviértelos.

function aRepresentacion(array $curso): array
{
    // TODO
    return [];
}

// =====================================================================
// PRESENTACIÓN — PARTE 3: las dos salidas
// =====================================================================
//   ?formato=json  -> cabecera application/json y el arreglo de
//                     representaciones, con json_encode
//   cualquier otro -> una tabla HTML MÍNIMA. Sin CSS, sin diseño: solo
//                     tiene que dejarte ver que el modelo funciona
//
// La misma lógica, dos representaciones. Esa es la idea del día.
//
// Recuerda escapar con htmlspecialchars en la rama HTML, y usar

// PHP_SAPI es 'cli' cuando se ejecuta desde la línea de comandos, y otra cosa cuando es HTTP
/**
 * cli: Command Line Interface (running scripts from a terminal or cron job)
 * Cli-server: PHP's built-in development web server
 * fpm-fcgi: PHP-FPM (FastCGI Process Manager) used in modern production
 */
if (PHP_SAPI !== 'cli') {

    // TODO: toda la presentación va aquí dentro
    // recuerda el uso de GET
    $formato=$_GET["formato"]??"json";

    if($formato==="json"){
        //json_encode();
        exit;
    }

    //imprimirHTML();

}

function imprimirHTML(array $datos): string{
    echo "";
}


// =====================================================================
// Comprobaciones. No las modifiquen.
// Al empezar fallan todas: vayan resolviéndolas de arriba hacia abajo.
// =====================================================================
$pasadas = 0;
$totales = 0;

function comprobar(string $descripcion, callable $prueba): void
{
    global $pasadas, $totales;

    $totales++;
    try {
        $ok = $prueba() === true;
    } catch (Throwable $e) {
        $ok = false;
        $descripcion .= '  (' . get_class($e) . ': ' . $e->getMessage() . ')';
    }

    $pasadas += $ok ? 1 : 0;
    printf("  [%s] %s\n", $ok ? 'ok' : '  ', $descripcion);
}

echo PHP_EOL, 'Comprobaciones', PHP_EOL;

// ---- Parte 1 --------------------------------------------------------
comprobar('Parte 1: de 12 cursos solo 11 están activos',
    fn(): bool => count(cursosVisibles($GLOBALS['cursos'])) === 11);
comprobar('Parte 1: el curso 12 está inactivo y no aparece, el 11 sí',
    fn(): bool => in_array(11,
            array_column(cursosVisibles($GLOBALS['cursos']), 'id'), true)
        && !in_array(12,
            array_column(cursosVisibles($GLOBALS['cursos']), 'id'), true));
comprobar('Parte 1: la categoría 2 trae los cursos 2 y 3',
    fn(): bool => array_column(cursosVisibles($GLOBALS['cursos'], 2), 'id') === [2, 3]);
comprobar('Parte 1: una categoría inexistente devuelve arreglo vacío',
    fn(): bool => cursosVisibles($GLOBALS['cursos'], 99) === []
        && cursosVisibles($GLOBALS['cursos'], 1) !== []);
comprobar('Parte 1: las claves van de 0 en adelante, sin huecos',
    fn(): bool => array_keys(cursosVisibles($GLOBALS['cursos']))
        === range(0, 10));


printf("%s%d de %d comprobaciones.%s", PHP_EOL, $pasadas, $totales, PHP_EOL);
