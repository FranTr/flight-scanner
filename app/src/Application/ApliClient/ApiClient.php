<?php

namespace App\Application\ApiClient;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface ApiClient
{
    public function sendRequest(RequestInterface $request, string $clientUri): ResponseInterface;
}