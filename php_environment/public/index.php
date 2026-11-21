<?php
/**
 * Frontal Controller: recibe todas las peticiones y las envía al controlador correspondiente.
 */

declare(strict_types=1);

/**
 * Carga automática de clases. No hay require_once en ningún otro archivo.
 */
require __DIR__ ."/app/Core/autoload.php";

// USes de clases del core. No hay require_once en ningún otro archivo.
use App\Core\HttpException;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;

Response::cors();

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Carga de controladores y dependencias. Devuelve un array de controladores.
$controllers= require __DIR__ . '/bootstrap.php';
$registerRoutes = require __DIR__ . '/routes/api.php';

$router = new Router();
$registerRoutes($router, $controllers);

try {
    $router->dispatch(Request::fromGlobals()); // FrontalController -> CoursesController -> CategoriesController
} catch (HttpException $e) {
    // El Service dijo 404/422/409; aquí se traduce a la respuesta.
    Response::error($e->status, $e->getMessage());
} catch (Throwable $e) {
    // Cualquier otra cosa es un 500. En producción no se muestra el
    // mensaje; en desarrollo ayuda.
    Response::error(500, $e->getMessage());
}
