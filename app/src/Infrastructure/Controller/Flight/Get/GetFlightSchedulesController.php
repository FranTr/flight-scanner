<?php


namespace App\Infrastructure\Controller\Flight\Get;


use App\Application\Flight\DataTransformer\FlightSchedulesDataTransformer;
use App\Application\Flight\Get\GetFlightSchedules;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetFlightSchedulesController extends AbstractController
{
    /** @var GetFlightSchedules */
    private $flightSchedules;

    /** @var  FlightSchedulesDataTransformer */
    private $flightSchedulesDataTransformer;

    public function __construct(
        GetFlightSchedules $flightSchedules,
        FlightSchedulesDataTransformer $flightSchedulesDataTransformer
    ) {
        $this->flightSchedules = $flightSchedules;
        $this->flightSchedulesDataTransformer = $flightSchedulesDataTransformer;
    }

    /**
     * @Route ("api/flightschedules/", name="flight schedules")
     */
    public function __invoke(Request $request)
    {
        $flightRoute = $request->get('flightRoute');
        $flightRouteType = $request->get('flightRouteType');

        $flightSchedules = $this->flightSchedules->get($flightRoute, $flightRouteType);
        $this->flightSchedulesDataTransformer->write($flightSchedules);

        return new Response($this->flightSchedulesDataTransformer->read(), 200);
    }
}