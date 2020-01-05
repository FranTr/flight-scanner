<?php

namespace App\Application\Client;

use GuzzleHttp\Psr7\Response;

interface ApiClient
{
    public function sendRequest(string $clientUri): Response;
}