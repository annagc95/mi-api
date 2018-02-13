<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


// Routes
// Grupo de rutas para el API
$app->group('/api', function () use ($app) {
  // Version group
  $app->group('/v1', function () use ($app) {
    $app->get('/hostings', 'obtenerHostings');
    $app->get('/hosting/{id}', 'obtenerHosting');
    $app->post('/crear', 'agregarHosting');
    $app->put('/actualizar/{id}', 'actualizarHosting');
    $app->delete('/eliminar/{id}', 'eliminarHosting');
  });
});
