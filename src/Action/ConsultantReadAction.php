<?php

namespace App\Action;

use App\Domain\Consultant\Service\ConsultantReader;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ConsultantReadAction
{
    private $consultantReader;

    public function __construct(ConsultantReader $consultantReader)
    {
        $this->consultantReader = $consultantReader;
    }

    public function __invoke(ServerRequest $request, Response $response, array $args = []): Response
    {
        // Collect input from the HTTP request
        $consultant_co_sistema = (int) $args['co_sistema'];
        $consultant_in_ativo = (string) $args['in_ativo'];
        $consultant_co_tipo_usuario = (array) $args['co_tipo_usuario'];

        // Invoke the Domain with inputs and retain the result
        $consultantData = $this->consultantReader->getConsultantDetails(
            $consultant_co_sistema,
            $consultant_in_ativo,
            $consultant_co_tipo_usuario
        );

        // Transform the result into the JSON representation
        $result = [
            'consultant_id' => $consultantData->id,
            'name' => $consultantData->name
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(200);
    }
}
