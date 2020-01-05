<?php


namespace App\Application\Flight\DataTransformer;

interface FlightRoutesDataTransformer
{
    public function write(array $flightRoutes): void;
    public function read(): string ;
}