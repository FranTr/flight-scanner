<?php

namespace App\Infrastructure\Controller\Flight\Get;

use App\Application\Flight\DataTransformer\FlightRoutesDataTransformer;
use App\Application\Flight\Get\GetAllFlightRoutes;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetAllFlightRoutesController extends AbstractController
{
    /** @var GetAllFlightRoutes */
    private $getAllFlightRoutes;
    /**
     * @var FlightRoutesDataTransformer
     */
    private $flightRoutesDataTransformer;

    public function __construct(
        GetAllFlightRoutes $getAllFlightRoutes,
        FlightRoutesDataTransformer $flightRoutesDataTransformer
    ) {
        $this->getAllFlightRoutes = $getAllFlightRoutes;
        $this->flightRoutesDataTransformer = $flightRoutesDataTransformer;
    }

    /**
     * @Route ("api/flightroutes", name="flight routes")
     */
    public function __invoke(): Response
    {
        $flightRoutes = $this->getAllFlightRoutes->getAll();
        $this->flightRoutesDataTransformer->write($flightRoutes);
        return new Response($this->flightRoutesDataTransformer->read(), 200);
    }
}