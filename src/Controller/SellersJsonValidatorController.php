<?php

namespace App\Controller;

use App\Analyzer\SellersJsonSimpleAnalyzer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * SellersJsonValidatorController.
 */
class SellersJsonValidatorController extends AbstractController
{
    public function __construct(HttpClientInterface $client, SellersJsonSimpleAnalyzer $analyser)
    {
        $this->client = $client;
        $this->analyser = $analyser;
    }

    /**
     * @Route("/validate/{url}", name="validate", requirements={"url" = "^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$"})
     */
    public function validate($url = '')
    {
        $response = $this->client->request(
            'GET',
            $url.'/sellers.json'
        );

        if ( $response->getStatusCode() == 200 )
        {
            $this->analyser->analyze(\json_decode($response->getContent(), true));

            if ($this->analyser->getSellers()) {
                $response = new JsonResponse(['code' => 200, 'sellers' => $this->analyser->getSellers()]);
                $response->setStatusCode(200);

                return $response;
            }
        }

        $response = $this->respond(404, 'seller.json not found');
        return $response;
    }

    private function respond(int $code, string $message)
    {
        $response = new JsonResponse(['code' => $code, 'message' => $message]);
        $response->setStatusCode($code);

        return $response;
    }
}
