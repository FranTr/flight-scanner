<?php


namespace App\Application\Flight\Factory;


use App\Domain\FlightRoute;
use stdClass;

class FlightRoutesFactory
{
    public function create(stdClass $flightRoutesConfigs): array
    {
        $flightRoutesFormatted = [];
        $flightRoutes = [];
        foreach ($flightRoutesConfigs->flightroutes as $flightRoutesConfig) {
            if(!array_key_exists($flightRoutesConfig->DepCode, $flightRoutesFormatted)) {
                $flightRoutesFormatted[$flightRoutesConfig->DepCode] = [
                    'name' => $flightRoutesConfig->DepName,
                    'destination' => [

                    ]
                ];
            }
            if(!array_key_exists(
                    $flightRoutesConfig->RetCode,
                    $flightRoutesFormatted[$flightRoutesConfig->DepCode]['destination']
                )
            ) {
                $flightRoutesFormatted[$flightRoutesConfig->DepCode]['destination'][$flightRoutesConfig->RetCode] =
                    $flightRoutesConfig->RetCode . ' - ' . $flightRoutesConfig->RetName;
            }
        }

        foreach ($flightRoutesFormatted as $key => $value) {
            $flightRoutes[] = new FlightRoute($key, $value['name'], $value['destination']);
        }
        return $flightRoutes;
    }
}