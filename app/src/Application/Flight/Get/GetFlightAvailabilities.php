<?php

namespace App\Application\Flight\Get;

use App\Application\Client\ApiClient;
use App\Application\Flight\Factory\FlightAvailabilityFactory;
use App\Domain\FlightAvailabilityRequest;

class GetFlightAvailabilities
{
    /**
     * @var ApiClient
     */
    private $client;
    /**
     * @var FlightAvailabilityFactory
     */
    private $flightAvailabilityFactory;

    public function __construct(
        ApiClient $client,
        FlightAvailabilityFactory $flightAvailabilityFactory
    ) {
        $this->client = $client;
        $this->flightAvailabilityFactory = $flightAvailabilityFactory;
    }

    public function getBy(
        string $departureDate,
        string $departureAirportCode,
        string $destinationAirportCode,
        ?string $returnDepartureAirportCode,
        ?string $returnDestinationAirportCode,
        ?string $returnDate
    ): array {
        $flightAvailabilityRequest = $this->flightAvailabilityFactory->createFlightAvailabilityRequest(
            $departureDate,
            $departureAirportCode,
            $destinationAirportCode,
            $returnDepartureAirportCode,
            $returnDestinationAirportCode,
            $returnDate
        );
        return $this->flightAvailabilityFactory->createFlightAvailabilityResponses(
            json_decode($this->client->sendRequest(
                $this->createUrlFromFlightAvailabilityRequest($flightAvailabilityRequest)
            )->getBody()->getContents(),
                true
            )
        );
    }

    private function createUrlFromFlightAvailabilityRequest(
        FlightAvailabilityRequest $flightAvailabilityRequest
    ): string {
        return $flightAvailabilityRequest->isOneWay()
            ? sprintf(
            'http://tstapi.duckdns.org/api/json/1F/flightavailability/'
            .'?departuredate=%s&departureairport=%s&destinationairport=%s',
            $flightAvailabilityRequest->getDepartureDate(),
            $flightAvailabilityRequest->getDepartureAirportCode(),
            $flightAvailabilityRequest->getDestinationAirportCode()
        )
            : sprintf(
            'http://tstapi.duckdns.org/api/json/1F/flightavailability/'
            .'?departuredate=%s&departureairport=%s&destinationairport=%s'
            .'&returndepartureairport=%s&returndestinationairport=%s&returndate=%s',
            $flightAvailabilityRequest->getDepartureDate(),
            $flightAvailabilityRequest->getDepartureAirportCode(),
            $flightAvailabilityRequest->getDestinationAirportCode(),
            $flightAvailabilityRequest->getReturnDepartureAirportCode(),
            $flightAvailabilityRequest->getReturnDestinationAirportCode(),
            $flightAvailabilityRequest->getReturnDate()
        );

    }
}