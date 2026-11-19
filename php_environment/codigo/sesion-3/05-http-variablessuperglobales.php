<?php

/**d
 * GET => $_GET | $_REQUEST
 * POST => $_POST | $_REQUEST
 * PUT => $_REQUEST
 * PATCH => $_REQUEST
 * DELETE => $_REQUEST
 * 
 * $_SERVER["REQUEST_METHOD"] => 
 */

// GET => LECTURA DATOSidCu
$method = $_SERVER["REQUEST_METHOD"];
//$titulo = $_REQ
$id= (int)$_GET["id"] ?? 0;

var_dump($id);

$cursos = require __DIR__ . "/../datos/cursos.php";

if (isset($_SERVER) && isset($method)) {
    if ($method !== "GET") {
        echo json_encode([
            "status" => "400",
            "message" => "Error de solicitud"
        ]);
        exit();
    }
}

$cursosRespuesta=$cursos;

if(!empty($id)){
    $cursosRespuesta=array_filter($cursos, fn($curso)=> $curso["id"]===$id);
}

//header("Content-Type: application/json; charset=utf-8");
echo json_encode($cursosRespuesta, JSON_UNESCAPED_UNICODE);

function mapClientFormat(array $data): array{
    return [
        "id"=> $data["id"],
        "title"=> $data["title"],
        "createdDate"=> $data["create_date"],
    ];
}

// created_date 
// createdDate

//echo $titulo;

//echo "Este componente se llamo mendiante el metodo HTTP: " . $method;
