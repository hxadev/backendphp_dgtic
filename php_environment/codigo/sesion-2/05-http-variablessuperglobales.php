<?php

// GET => LECTURA DATOS
$method = $_SERVER["REQUEST_METHOD"];
$titulo = $_REQUEST["titulo"];

$cursos = require __DIR__ . "/../datos/cursos.php";


if (isset($_SERVER) && isset($method)) {
    if ($method !== "GET") {
        echo json_encode([
            "status" => "400",
            "message" => "Error de solicitud"
        ]);
    }
}
header("Content-Type: application/json; charset=utf-8");
echo json_encode($cursos, JSON_UNESCAPED_UNICODE);

//echo $titulo;

//echo "Este componente se llamo mendiante el metodo HTTP: " . $method;
