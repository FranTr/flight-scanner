<?php


namespace App\Infrastructure\DataTransformers\Flight;

use App\Application\Flight\DataTransformer\FlightRoutesDataTransformer;

    class JsonFlightRoutesDataTransformer implements FlightRoutesDataTransformer
{
    /** @var array */
    private $data;

    public function write(array $flightRoutes): void
    {
        foreach ($flightRoutes as $flightRoute) {
            $this->data[$flightRoute->getDepartureCode()] = [
                'name' => $flightRoute->getDepartureCode() . ' - ' . $flightRoute->getDepartureName(),
                'destinations' => $flightRoute->getDestinations()
            ];
        }
        $this->data = json_encode($this->data);
    }

    public function read(): string
    {
        return $this->data;
    }
}