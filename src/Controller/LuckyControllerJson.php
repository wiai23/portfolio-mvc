<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerJson
{
    #[Route("/api")]
    public function jsonNumber(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'route-one' => '/api',
            'route-two' => '/api/quote',
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/quote")]
    public function jsonQuote(): Response
    {
        $int = floor(time() / (60*60*24)) % 3;

        // Set the timezone to use
        date_default_timezone_set('Europe/Stockholm');

        // The date of today
        $today = date('Y-m-d H:i:s');


        switch ($int) {
            case 0:
                $str = "Erfarenhet ar det namn alla ger sina misstag. // Oscar Wilde. Dagens datum $today";
                break;
            case 1:
                $str = "Vänskap kan bara köpas med vänskap. // Thomas Wilson. Dagens datum $today";
                break;
            case 2:
                $str = "Godhet är den enda investering som aldrig är felplacerad. // David Thoreau. Dagens datum $today";
                break;
        }

        return new JsonResponse($str);
    }
}