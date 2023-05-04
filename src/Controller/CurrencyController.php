<?php

namespace App\Controller;

use App\Entity\Currency;
use App\Entity\Rate;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyController extends AbstractController
{
    #[Route('/api/currencies', name: 'app_currency_index', methods: ['GET'])]
    public function index(CurrencyRepository $currencyRepository): JsonResponse
    {
        return $this->json(
            $currencyRepository->findAll(),
            JsonResponse::HTTP_OK
        );
    }

    #[Route('/api/currencies/{id}', name: 'app_currency_show', requirements: ['id' => '^[A-Z]{3}$'], methods: ['GET'])]
    public function show(?Currency $baseCurrency, CurrencyRepository $currencyRepository): JsonResponse
    {
        if (!$baseCurrency) {
            return $this->json(
                ['error' => 'Currency not found'],
                JsonResponse::HTTP_NOT_FOUND
            );
        }

        return $this->json(
            $currencyRepository->find($baseCurrency),
            JsonResponse::HTTP_OK
        );
    }
}
