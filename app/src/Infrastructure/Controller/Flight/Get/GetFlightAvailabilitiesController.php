<?php


namespace App\Infrastructure\Controller\Flight\Get;


use App\Application\Flight\DataTransformer\FlightAvailabilitiesDataTransformer;
use App\Application\Flight\Get\GetFlightAvailabilities;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetFlightAvailabilitiesController extends AbstractController
{
    /** @var GetFlightAvailabilities */
    private $flightAvailabilities;

    /** @var FlightAvailabilitiesDataTransformer */
    private $flightAvailabilitiesDataTransformer;

    public function __construct(
        GetFlightAvailabilities $flightAvailabilities,
        FlightAvailabilitiesDataTransformer $flightAvailabilitiesDataTransformer
    ) {
        $this->flightAvailabilities = $flightAvailabilities;
        $this->flightAvailabilitiesDataTransformer = $flightAvailabilitiesDataTransformer;
    }

    /**
     * @Route ("api/flightavailability/", name="flight availability")
     */
    public function __invoke(Request $request): Response
    {
        $departureDate = $request->get('departureDate');
        $departureAirportCode = $request->get('departureAirportCode');
        $destinationAirportCode = $request->get('destinationAirportCode');
        $returnDepartureAirportCode = $request->get('returnDepartureAirportCode');
        $returnDestinationAirportCode = $request->get('returnDestinationAirportCode');
        $returnDate = $request->get('returnDate');
        $flightAvailabilities = $this->flightAvailabilities->getBy(
            $departureDate,
            $departureAirportCode,
            $destinationAirportCode,
            $returnDepartureAirportCode,
            $returnDestinationAirportCode,
            $returnDate
            );
        $this->flightAvailabilitiesDataTransformer->write($flightAvailabilities);
        return new Response($this->flightAvailabilitiesDataTransformer->read(), Response::HTTP_OK);
    }
}