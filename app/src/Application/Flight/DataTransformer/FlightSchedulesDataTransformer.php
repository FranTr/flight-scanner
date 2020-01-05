<?php

namespace App\Application\Flight\DataTransformer;

interface FlightSchedulesDataTransformer
{
    public function write(array $flightSchedules): void;
    public function read(): string ;
}