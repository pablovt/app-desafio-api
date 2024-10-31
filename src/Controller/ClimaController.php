<?php
// src/Controller/ClimaController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClimaController extends AbstractController
{
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    #[Route('/api/clima', name: 'app_clima')]
    public function getClima(Request $request): JsonResponse
    {
        $cityName = $request->query->get('city_name');
        $apiKey = '42b1a8f8';

        try {
            $response = $this->httpClient->request('GET', 'https://api.hgbrasil.com/weather', [
                'query' => [
                    'key' => $apiKey,
                    'city_name' => $cityName,
                ]
            ]);

            $data = $response->toArray();
            return $this->json($data);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Erro ao buscar dados de clima - API HG Brasil'], 500);
        }
    }
}
