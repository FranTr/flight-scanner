<?php


namespace App\Domain;


class FlightRoute
{
    /** @var string */
    private $departureCode;

    /** @var string */
    private $departureName;

    /** @var array */
    private $destinations;

    public function __construct(
        string $departureCode,
        string $departureName,
        array $destinations
    ) {
        $this->departureCode = $departureCode;
        $this->departureName = $departureName;
        $this->destinations = $destinations;
    }

    public function getDepartureCode(): string
    {
        return $this->departureCode;
    }

    public function getDepartureName(): string
    {
        return $this->departureName;
    }

    public function getDestinations(): array
    {
        return $this->destinations;
    }

}