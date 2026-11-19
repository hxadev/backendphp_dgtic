<?php
$cursos = require __DIR__ . "/../datos/cursos.php";


session_start();


//$_SESSION
// Contador de visitas

//$visitas=($visitas ?? 0)+1;

$visitas = $_SESSION["visitas"] = ($_SESSION["visitas"] ?? 0) + 1;

echo "Contador de Visitas: $visitas";

session_abort();

if($visitas >= 10){
    http_response_code(200);
    setcookie("logrado",date("H:i:s"));

    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($cursos);
}
