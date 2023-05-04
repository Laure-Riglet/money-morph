<?php

namespace App\Command;

use App\Entity\Currency;
use App\Entity\Rate;
use App\Service\CurrencyExchangeApiService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:rates-update',
    description: 'Hourly update of currency rates',
)]
class RatesUpdateCommand extends Command
{
    private $entityManager;
    private $currencyExchangeApiService;

    public function __construct(CurrencyExchangeApiService $currencyExchangeApiService, EntityManagerInterface $entityManager)
    {
        $this->currencyExchangeApiService = $currencyExchangeApiService;
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Updating currency rates');
        $currencies = $this->entityManager->getRepository(Currency::class)->findAll();
        $io->progressStart(count($currencies));
        foreach ($currencies as $baseCurrency) {
            foreach ($currencies as $intoCurrency) {
                if ($baseCurrency !== $intoCurrency) {
                    $rate = new Rate();
                    $rate->setBaseCurrency($baseCurrency);
                    $rate->setIntoCurrency($intoCurrency);
                    $rate->setValue($this->currencyExchangeApiService->fetchRates($baseCurrency->getId(), $intoCurrency->getId()));
                    $rate->setCreatedAt(new DateTimeImmutable());
                    $rate->setId($rate->getCreatedAt()->format('ymd') . '-' . $baseCurrency->getId() . '-' . $intoCurrency->getId());
                    $this->entityManager->getRepository(Rate::class)->save($rate, true);
                }
            }
            $io->progressAdvance();
        }

        $io->success('Exchange rates updated!');

        return Command::SUCCESS;
    }
}
