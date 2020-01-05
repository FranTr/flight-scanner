<?php

namespace App\Infrastructure\Client;

use App\Application\Client\ApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class GuzzleApiClient implements ApiClient
{
    public function sendRequest(string $clientUri): Response
    {
       $client = new Client();
       return $client->get($clientUri,
           [
               'auth' => [
                   getenv('FLIGHT_API_USERNAME'),
                   getenv('FLIGHT_API_PASSWORD')
               ],
           ]
       );
    }
}