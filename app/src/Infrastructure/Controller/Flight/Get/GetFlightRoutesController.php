<?php


namespace App\Infrastructure\Controller\Flight\Get;


use App\Application\Flight\DataTransformer\FlightRoutesDataTransformer;
use App\Application\Flight\Get\GetFlightRoutes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetFlightRoutesController extends AbstractController
{
    /** @var GetFlightRoutes */
    private $flightRoutes;

    /** @var FlightRoutesDataTransformer */
    private $flightRoutesDataTransformer;

    public function __construct(
        GetFlightRoutes $flightRoutes,
        FlightRoutesDataTransformer $flightRoutesDataTransformer
    ) {
        $this->flightRoutes = $flightRoutes;
        $this->flightRoutesDataTransformer = $flightRoutesDataTransformer;
    }

    /**
     * @Route ("api/flightroute/{id}", name="flight route")
     */
    public function __invoke(string $id): Response
    {
        $flightRoutes = $this->flightRoutes->getByDepartureAirportCode($id);
        $this->flightRoutesDataTransformer->write($flightRoutes);

        return new Response($this->flightRoutesDataTransformer->read(), 200);
    }
}