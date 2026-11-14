<?php

// require => incluir algun archivo externo .php dentro del archivo actual, será incluido las veces que sea llamado 03-control.php
// require_once => incluir algun archivo externo .php dentro del archivo actual, solo se incluirá una sola vez.


$categorias = require __DIR__ ."/../datos/categorias.php";
$cursos = require __DIR__ ."/../datos/cursos.php";
$niveles = require __DIR__ ."/../datos/niveles.php";

// var_dump($categorias);

// Que estructura de control iterativa vamos a necesitar?

var_dump(count($categorias));

// For index
for( $i=0; $i < count($categorias); $i++){
    $categoria = $categorias[$i];

    $isActive = $categoria["active"] ?? false;
    $title = $categoria["name"] ?? "NO CATEGORY";

    //echo "Categoria == $title == : Activa $isActive", PHP_EOL;

}

// ForEach
foreach($categorias as $categoria){

    $isActive = $categoria["active"] ?? false;

    if(!$isActive) continue; 

    $title = $categoria["name"] ?? "NO NAME";

    //echo "<p>$title</p>";
    //echo "<br>";

}


// casting int, float, string
$totalPrice=0;
foreach($cursos as $curso){
    $price = (float) $curso["price"] ?? 0;
    $totalPrice += $price;
}

// echo "El costo total de mi inventario es: $$totalPrice";

// BD
/*while(true){
    break;
    continue;

}

do{
    break;
    continue;
}while(true);*/

// Obtener todos los titulos de mis cursos

$titulosCursos=array_column($cursos,"title");
$titulosIndexados=array_column($cursos,"title","id");
var_dump($titulosIndexados);

echo "El curso seleccionado: ".$titulosIndexados[5];

// Total de cursos
$totalCursos=count($cursos);

// funciones

?>


