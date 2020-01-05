<?php

namespace App\Application\Flight\Factory;

use App\Domain\FlightAvailabilityRequest;
use App\Domain\FlightAvailabilityResponse;

class FlightAvailabilityFactory
{
    public function createFlightAvailabilityRequest(
        string $departureDate,
        string $departureAirportCode,
        string $destinationAirportCode,
        ?string $returnDepartureAirportCode,
        ?string $returnDestinationAirportCode,
        ?string $returnDate
    ): FlightAvailabilityRequest {
        return new FlightAvailabilityRequest(
            $departureDate,
            $departureAirportCode,
            $destinationAirportCode,
            $returnDepartureAirportCode,
            $returnDestinationAirportCode,
            $returnDate
        );
    }

    public function createFlightAvailabilityResponses(array $response): array
    {
        $flightAvailabilityResponses = [];
        foreach ($response['flights']['OUT'] as $flight) {
            $flightAvailabilityResponses['OUT'][] = new FlightAvailabilityResponse(
                $flight['datetime'],
                $flight['price'],
                $flight['duration'],
                $flight['seatsAvailable'],
                $flight['depart']['airport']['name'],
                $flight['depart']['airport']['code'],
                $flight['arrival']['airport']['name'],
                $flight['arrival']['airport']['code']
            );
        }

        if (array_key_exists('RET', $response['flights'])) {
            foreach ($response['flights']['RET'] as $flight) {
                $flightAvailabilityResponses['RET'][] = new FlightAvailabilityResponse(
                    $flight['datetime'],
                    $flight['price'],
                    $flight['duration'],
                    $flight['seatsAvailable'],
                    $flight['depart']['airport']['name'],
                    $flight['depart']['airport']['code'],
                    $flight['arrival']['airport']['name'],
                    $flight['arrival']['airport']['code']
                );
            }
        }
        return $flightAvailabilityResponses;
    }
}