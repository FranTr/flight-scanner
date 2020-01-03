<?php

namespace App\Infrastructure\ApiClient;

use App\Application\ApiClient\ApiClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

class GuzzleApiClient implements ApiClient
{

    public function sendRequest(RequestInterface $request, string $clientUri): ResponseInterface
    {
        // TODO: Implement sendRequest() method.
    }
}