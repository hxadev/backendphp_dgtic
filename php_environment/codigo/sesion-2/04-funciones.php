<?php

declare(strict_types=1);
// Scopes - Ámbito
// Local => Definido en cada funcion $Variable RECOMENDADO!
// Global => Definido en cada funcion con la palabra reservada global $Variable

$cursos = require __DIR__ . "/../datos/cursos.php";

// Function con o sin parametros

function obtenerTotalCursos(array $curso): int
{
    $tituloCurso="Programacion en Java";
    // Declare $ // Ambito Local
    return count($curso);
}

$totalCursos = obtenerTotalCursos(curso: $cursos);


// Funciones Tipadas con Nombre
function obtenerCursosConLimiteDePrecio(array $cursos, int $precioLimite): array
{
    
    $resultado = array();
    foreach ($cursos as $curso) {
        if (!$curso["active"]) continue;

        if ($curso["price"] < $precioLimite) {
            array_push($resultado, $curso);
        }
    }

    return $resultado;
}

// Funcion Anonima
$obtenerTitulosCursos = function (array $cursos): array {
    return array_column($cursos, "title");
};

//echo $totalCursos;
$cursosFiltrados = obtenerCursosConLimiteDePrecio(precioLimite: 3000, cursos: $cursos);

//Todos los parametros deben de tener dinamismo
function imprimirDetallesCurso(array $curso, string $formato): void {
    if (!isset($formato)){
        echo "Formato Invalido"; // Mensaje al usuario
        return; // Rompe ejecucion del flujo de la funcion
    }

    $idCurso=$curso["id"];

    /**
     * string : any_type
     * {"key": "value"} => FRONT <=JSON=> BACK
     */

    if($formato==="JSON"){ 
        echo json_encode($curso); // => json_decode("{"id":1}", associativeArray)
    }elseif($formato==="HTML"){
        echo "<h1>ID: $idCurso</h1>";
    }elseif($formato==="MARKDOWN"){
        echo "## ID: $idCurso";
    }else{ // Texto plano
        echo "$idCurso";
    }
}

// array_filter($array, fn()=>true|false) => expresion booleana
// array_map(fn()=>,$array) => )
/**
 * BIG O => O(n)
 * 
 */
function obtenerCursosConDuracionLimite(array $cursos, int $durationLimit): array {
    
    return array_filter($cursos, fn($curso)=> $curso["duration"] < $durationLimit);
};

function obtenerVistaSimpleCurso(array $cursos): ?array{

    // Cuando sepamos que excepcion puede arrojar la funcion: ArithmeticError, DivisionByZeroError
    // Cuando no sepamos que excepcion puede arroja la funcion: Throwable
    $hasTitle=array_key_exists("titulo", $cursos);
    try{
        if(isset($cursos)) throw new Exception("Los cursos no pueden estár vacios.");
        if(count($cursos)>100) throw new Exception("Debe de existir un limite de procesamiento para los cursos, entrega solo 100 cursos");
    }catch(Throwable $ex){
        echo "Fallo la ejecucion: Intenta de nuevo ";
        return null;
    }
    
}


 $cursosFiltradosPorLimite=obtenerCursosConDuracionLimite($cursos, 30);

//var_dump($cursosFiltradosPorLimite[2]);
//$cursos=["1","2",3,false];
//var_dump(obtenerVistaSimpleCurso($cursos));


 imprimirDetallesCurso($cursosFiltradosPorLimite[2],"JSON");

