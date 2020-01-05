<?php


namespace App\Application\Flight\DataTransformer;


interface FlightAvailabilitiesDataTransformer
{
    public function write(array $flightAvailabilities): void;
    public function read(): string ;
}