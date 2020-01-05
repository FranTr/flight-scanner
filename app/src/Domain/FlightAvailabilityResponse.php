<?php


namespace App\Domain;


use DateInterval;
use DateTime;

class FlightAvailabilityResponse
{
    /** @var DateTime */
    private $departureTime;

    /** @var float */
    private $price;

    /** @var string */
    private $duration;

    /** @var int */
    private $seatsAvailables;

    /** @var string */
    private $departureAirportName;

    /** @var string */
    private $departureAirportCode;

    /** @var string */
    private $destinationAirportName;

    /** @var string */
    private $destinationAirportCode;

    /** @var DateTime */
    private $arrivalTime;

    public function __construct(
        string $departureTime,
        float $price,
        string $duration,
        int $seatsAvailables,
        string $departureAirportName,
        string $departureAirportCode,
        string $destinationAirportName,
        string $destinationAirportCode
    )
    {
        $this->departureTime = new Datetime( date("Y-m-d H:i:s", strtotime($departureTime)));
        $this->price = $price;
        $this->duration = $duration;
        $this->seatsAvailables = $seatsAvailables;
        $this->departureAirportName = $departureAirportName;
        $this->departureAirportCode = $departureAirportCode;
        $this->destinationAirportName = $destinationAirportName;
        $this->destinationAirportCode = $destinationAirportCode;
    }

    public function getDepartureTime(): string
    {
        return $this->departureTime->format("Y-m-d H:i:s");
    }

    public function getArrivalTime(): string
    {
        sscanf($this->duration, "%d:%d:%d", $hours, $minutes, $seconds);
        $seconds = isset($hours) ? $hours * 3600 + $minutes * 60 + $seconds : $minutes * 60 + $seconds;
        $secondsFormatted = "PT".$seconds."S";
        $this->arrivalTime = $this->departureTime;
        $this->arrivalTime->add(new DateInterval($secondsFormatted));
        return $this->arrivalTime->format("Y-m-d H:i:s");
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function getSeatsAvailables(): int
    {
        return $this->seatsAvailables;
    }

    public function getDepartureAirportName(): string
    {
        return $this->departureAirportName;
    }

    public function getDepartureAirportCode(): string
    {
        return $this->departureAirportCode;
    }

    public function getDestinationAirportName(): string
    {
        return $this->destinationAirportName;
    }

    public function getDestinationAirportCode(): string
    {
        return $this->destinationAirportCode;
    }

}