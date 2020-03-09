<?php

/* use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\App;

return function (App $app) {
    $app->get('/', function (ServerRequest $request, Response $response) {
        $response->getBody()->write('Hello, World!');

        return $response;
    });
}; */

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class);
    $app->get('/consultants/{co_sistema}&{in_ativo}&{co_tipo_usuario}', \App\Action\ConsultantReadAction::class);
    $app->get('/users/{id}', \App\Action\UserReadAction::class);
    $app->post('/users', \App\Action\UserCreateAction::class);
};