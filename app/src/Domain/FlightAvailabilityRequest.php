<?php


namespace App\Domain;


use DateTime;

class FlightAvailabilityRequest
{
    /** @var DateTime */
    private $departureDate;

    /** @var string */
    private $departureAirportCode;

    /**@var string */
    private $destinationAirportCode;

    /** @var string|null */
    private $returnDepartureAirportCode;

    /** @var string|null */
    private $returnDestinationAirportCode;

    /** @var DateTime|null */
    private $returnDate;

    public function __construct(
        string $departureDate,
        string $departureAirportCode,
        string $destinationAirportCode,
        ?string $returnDepartureAirportCode,
        ?string $returnDestinationAirportCode,
        ?string $returnDate
    )
    {

//        $this->departureDate = new DateTime($departureDate);
        $this->departureDate = DateTime::createFromFormat('D M d Y H:i:s e+', $departureDate);
        $this->departureAirportCode = $departureAirportCode;
        $this->destinationAirportCode = $destinationAirportCode;
        $this->returnDepartureAirportCode = $returnDepartureAirportCode;
        $this->returnDestinationAirportCode = $returnDestinationAirportCode;
//        $this->returnDate = $returnDate ? new DateTime($returnDate) : null;
        $this->returnDate = $returnDate ? DateTime::createFromFormat('D M d Y H:i:s e+', $returnDate) : null;
    }

    public function getDepartureDate(): string
    {
        return $this->departureDate->format('Ymd');
    }

    public function getDepartureAirportCode(): string
    {
        return $this->departureAirportCode;
    }

    public function getDestinationAirportCode(): string
    {
        return $this->destinationAirportCode;
    }

    public function getReturnDepartureAirportCode(): ?string
    {
        return $this->returnDepartureAirportCode;
    }

    public function getReturnDestinationAirportCode(): ?string
    {
        return $this->returnDestinationAirportCode;
    }

    public function getReturnDate(): ?string
    {
        return $this->returnDate->format('Ymd');
    }

    public function isOneWay()
    {
        return !$this->returnDepartureAirportCode || !$this->returnDestinationAirportCode || !$this->returnDate;
    }
}