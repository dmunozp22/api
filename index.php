<?php
// Habilitar CORS para permitir el acceso desde el frontend
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Autocarga de las dependencias instaladas con Composer
require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

// Ruta para sumar dos números
$app->get('/sumar/{num1}/{num2}', function ($request, $response, $args) {
    $num1 = (float)$args['num1'];
    $num2 = (float)$args['num2'];
    $resultado = $num1 + $num2;
    $response->getBody()->write(json_encode(['resultado' => $resultado]));
    return $response->withHeader('Content-Type', 'application/json');
});

// Ruta para restar dos números
$app->get('/restar/{num1}/{num2}', function ($request, $response, $args) {
    $num1 = (float)$args['num1'];
    $num2 = (float)$args['num2'];
    $resultado = $num1 - $num2;
    $response->getBody()->write(json_encode(['resultado' => $resultado]));
    return $response->withHeader('Content-Type', 'application/json');
});

// Ruta para multiplicar dos números
$app->get('/multiplicar/{num1}/{num2}', function ($request, $response, $args) {
    $num1 = (float)$args['num1'];
    $num2 = (float)$args['num2'];
    $resultado = $num1 * $num2;
    $response->getBody()->write(json_encode(['resultado' => $resultado]));
    return $response->withHeader('Content-Type', 'application/json');
});

// Ruta para dividir dos números
$app->get('/dividir/{num1}/{num2}', function ($request, $response, $args) {
    $num1 = (float)$args['num1'];
    $num2 = (float)$args['num2'];
    if ($num2 == 0) {
        $response->getBody()->write(json_encode(['error' => 'No se puede dividir entre cero']));
    } else {
        $resultado = $num1 / $num2;
        $response->getBody()->write(json_encode(['resultado' => $resultado]));
    }
    return $response->withHeader('Content-Type', 'application/json');
});

// Correr la aplicación
$app->run();
