<?php


namespace App\Application\Flight\Get;


use App\Application\Client\ApiClient;
use App\Application\Flight\Factory\FlightRoutesFactory;

class GetFlightRoutes
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

    public function getByDepartureAirportCode(string $departureAirportCode): array
    {
        return $this->flightRoutesFactory->create(
            json_decode(
                $this->apiClient
                    ->sendRequest($this->getUrl($departureAirportCode))
                    ->getBody()
                    ->getContents()
            )
        );
    }

    public function getUrl(string $departureAirportCode): string
    {
        return 'http://tstapi.duckdns.org/api/json/1F/flightroutes?departureairport=' . $departureAirportCode;
    }
}