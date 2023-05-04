<?php

namespace App\Controller;

use App\Entity\Rate;
use App\Repository\RateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RateController extends AbstractController
{
    #[Route('/api/rates', name: 'app_rate_index', methods: ['GET'])]
    public function index(RateRepository $rateRepository): JsonResponse
    {
        return $this->json(
            $rateRepository->findAll(),
            JsonResponse::HTTP_OK,
            [],
            ['groups' => ['rate']]
        );
    }

    #[Route('/api/rates/{id}', name: 'app_rate_show', requirements: ['id' => '^\d{6}\-[A-Z]{3}\-[A-Z]{3}$'], methods: ['GET'])]
    public function show(?Rate $rate): JsonResponse
    {
        if (!$rate) {
            return $this->json(
                ['error' => 'Rate not found'],
                JsonResponse::HTTP_NOT_FOUND
            );
        }
        return $this->json(
            $rate,
            JsonResponse::HTTP_OK,
            [],
            ['groups' => ['rate']]
        );
    }
}
