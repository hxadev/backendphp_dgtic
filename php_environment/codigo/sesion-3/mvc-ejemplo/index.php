<?php

/**
 * FRONT CONTROLLER => Yo soy la unica puerta de entrada para la plataforma
 */

// Carga de todos los componentes


// bootstrap component => 
require __DIR__."/Controller/CourseController.php";
require __DIR__."/Model/CourseModel.php";
require __DIR__."/View/LearnhubView.php";

// Requerir los datos necesarios
$cursos = require __DIR__ ."/../../datos/cursos.php";

// Router -> / /catalogo

// Si pagina es vacio o nulo, entonces por defecto la pagina a mostrar es catalogo
$pagina=$_GET["pagina"]??"catalogo";

match($pagina){
    "catalogo" => index($cursos),
    "detalle" => detailCourse($cursos),
    default => defaultCourse()
};
