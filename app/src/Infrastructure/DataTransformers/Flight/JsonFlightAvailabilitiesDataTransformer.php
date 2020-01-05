<?php


namespace App\Infrastructure\DataTransformers\Flight;


use App\Application\Flight\DataTransformer\FlightAvailabilitiesDataTransformer;
use App\Domain\FlightAvailabilityResponse;

class JsonFlightAvailabilitiesDataTransformer implements FlightAvailabilitiesDataTransformer
{
    /** @var array */
    private $data;

    public function write(array $flightAvailabilities): void
    {
        /**
         * @var  $key
         * @var  FlightAvailabilityResponse $flightAvailability
         */

        foreach ($flightAvailabilities['OUT'] as $flightAvailability) {
            $this->data['OUT'][] = [
                'departureTime' => $flightAvailability->getDepartureTime(),
                'arrivalTime' => $flightAvailability->getArrivalTime(),
                'price' => $flightAvailability->getPrice(),
                'seatsAvailables' => $flightAvailability->getSeatsAvailables(),
                'departureAirport' => [
                    'code' => $flightAvailability->getDepartureAirportCode(),
                    'name' => $flightAvailability->getDepartureAirportName()
                ],
                'destinationAirport' => [
                    'code' => $flightAvailability->getDestinationAirportCode(),
                    'name' => $flightAvailability->getDestinationAirportName()
                ]
            ];
        }
        if (array_key_exists('RET', $flightAvailabilities)) {
            foreach ($flightAvailabilities['RET'] as $flightAvailability) {
                $this->data['RET'][] = [
                    'departureTime' => $flightAvailability->getDepartureTime(),
                    'arrivalTime' => $flightAvailability->getArrivalTime(),
                    'price' => $flightAvailability->getPrice(),
                    'seatsAvailables' => $flightAvailability->getSeatsAvailables(),
                    'departureAirport' => [
                        'code' => $flightAvailability->getDepartureAirportCode(),
                        'name' => $flightAvailability->getDepartureAirportName()
                    ],
                    'destinationAirport' => [
                        'code' => $flightAvailability->getDestinationAirportCode(),
                        'name' => $flightAvailability->getDestinationAirportName()
                    ]
                ];
            }
        }

        $this->data = json_encode($this->data);
    }

    public function read(): string
    {
        return $this->data;
    }
}