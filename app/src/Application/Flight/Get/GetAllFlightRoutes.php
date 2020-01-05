<?php

namespace App\Application\Flight\Get;

use App\Application\Client\ApiClient;
use App\Application\Flight\Factory\FlightRoutesFactory;

class GetAllFlightRoutes
{
    /** @var ApiClient */
    private $apiClient;

    /** @var FlightRoutesFactory */
    private $flightRoutesFactory;

    public function __construct(ApiClient $apiClient, FlightRoutesFactory $flightRoutesFactory)
    {
        $this->apiClient = $apiClient;
        $this->flightRoutesFactory = $flightRoutesFactory;
    }

    public function getAll(): array
    {
        $flightRoutes = $this->flightRoutesFactory->create(
            json_decode($this->apiClient
                ->sendRequest('http://tstapi.duckdns.org/api/json/1F/flightroutes')
                ->getBody()
                ->getContents()
            )
        );
        return $flightRoutes;
    }
}