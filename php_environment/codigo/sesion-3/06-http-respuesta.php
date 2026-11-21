<?php


$cursos = require __DIR__ . "/../datos/cursos.php";

$filtro = isset($_GET["filtro"]) ?? null;

$idCurso = isset($_GET["id"]) ?? 1;
$categoria = $_GET["categoria"] ?? 1;
$ranking = $_GET["ranking"] ?? 3;

function getErrorResponse(int $errorCode, string $message)
{
    return [
        "status" => $errorCode,
        "message" => $message
    ];
}


/*elseif(isset($filtro) && (isset($idCurso) || isset($categoria) || isset($ranking))){
    http_response_code(202); // Accepted
    echo json_encode($cursos);
    exit;
}*/

header("Content-Type: application/json; charset=utf-8");
if (!isset($filtro)) { // Respuesta por defecto
    // Resultado de solicitud
    http_response_code(200); // Success
    echo json_encode($cursos);
    exit;
} elseif ($filtro === "titulo") {
    http_response_code(400); // Bad Request
    echo json_encode(getErrorResponse(400, "Este filtro no es permitido"));
} else {
    http_response_code(400); // Bad Request
    echo json_encode(getErrorResponse(400, "Los parametros solicitados son invalidos"));
    exit;
}
