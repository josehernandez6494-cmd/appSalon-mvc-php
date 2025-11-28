<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
use Controllers\CitaController;
use Controllers\APIController;
use Controllers\AdminController;
use Controllers\ServicioCotroller;

$router = new Router();

//Iniciar sesión y revisar si el usuario está autenticado
$router->get('/', [loginController::class, 'login']);
$router->post('/', [loginController::class, 'login']);
$router->get('/logout', [loginController::class, 'logout']);

// Rutas para recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

// Rutas para Crear una cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);  

// Rutas para confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// rutas para el área privada
$router->get('/cita', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

// rutas para la API de citas
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

// Rutas para el CRUD de servicios
$router->get('/servicios', [ServicioCotroller::class, 'index']);
$router->get('/servicios/crear', [ServicioCotroller::class, 'crear']);
$router->post('/servicios/crear', [ServicioCotroller::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioCotroller::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioCotroller::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioCotroller::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();