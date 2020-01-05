<?php


namespace App\Infrastructure\DataTransformers\Flight;


use App\Application\Flight\DataTransformer\FlightSchedulesDataTransformer;

class JsonFlightSchedulesDataTransformer implements FlightSchedulesDataTransformer
{
    /** @var array */
    private $data;

    public function write(array $flightSchedules): void
    {

        foreach ($flightSchedules['flightschedules']['OUT'] as $key => $schedule) {
            $this->data['OUT'][] = $schedule['date'];
        }
        if (array_key_exists('RET', $flightSchedules['flightschedules'])) {
            foreach ($flightSchedules['flightschedules']['RET'] as $key => $schedule) {
                $this->data['RET'][] = $schedule['date'];
            }
        }
        $this->data = json_encode($this->data);
    }

    public function read(): string
    {
        return $this->data;
    }
}