<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurrencyExchangeApiService
{
    private $client;
    private $apiKey;

    public function __construct(HttpClientInterface $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function fetchRates(string $baseCurrencyId, string $intoCurrencyId): float
    {
        $response = $this->client->request(
            'GET',
            'https://currency-exchange.p.rapidapi.com/exchange',
            [
                'headers' => [
                    'X-RapidAPI-Host' => 'currency-exchange.p.rapidapi.com',
                    'X-RapidAPI-Key' => $this->apiKey,
                    'content-type' => 'application/octet-stream',
                ],
                'query' => [
                    'from' => $baseCurrencyId,
                    'to' => $intoCurrencyId,
                    'q' => 1.0,
                ],
            ]
        );
        return $response->getContent();
    }
}
