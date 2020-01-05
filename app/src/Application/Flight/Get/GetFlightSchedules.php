<?php

namespace App\Application\Flight\Get;

use App\Application\Client\ApiClient;

class GetFlightSchedules
{

    /** @var ApiClient */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function get(array $flightRoute, string $flightRouteType): array
    {
        return json_decode(
            $this->client
                ->sendRequest($this->createUrl($flightRoute, $flightRouteType))
                ->getBody()
                ->getContents(),
            true
        );
    }

    private function createUrl(array $flightRoute, string $flightRouteType)
    {
        return $flightRouteType === 'one-way'
            ? sprintf(
                'http://tstapi.duckdns.org/api/json/1F/flightschedules/?departureairport=%s&destinationairport=%s',
                $flightRoute['departure'],
                $flightRoute['destination']
            )
            : sprintf(
                'http://tstapi.duckdns.org/api/json/1F/flightschedules/?departureairport=%s&destinationairport=%s&returndepartureairport=%s&returndestinationairport=%s',
                $flightRoute['departure'],
                $flightRoute['destination'],
                $flightRoute['destination'],
                $flightRoute['departure']
            );
    }
}