<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: RateRepository::class)]
class Rate
{
    #[ORM\Id]
    #[ORM\Column(length: 14)]
    #[Groups(['rate'])]
    private string $id;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['rate'])]
    private ?Currency $baseCurrency;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['rate'])]
    private ?Currency $intoCurrency;

    #[ORM\Column]
    #[Groups(['rate'])]
    private ?\DateTimeImmutable $createdAt;

    #[ORM\Column]
    #[Groups(['rate'])]
    private ?float $value;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): Rate
    {
        $this->id = $id;

        return $this;
    }

    public function getBaseCurrency(): ?Currency
    {
        return $this->baseCurrency;
    }

    public function setBaseCurrency(?Currency $baseCurrency): self
    {
        $this->baseCurrency = $baseCurrency;

        return $this;
    }

    public function getIntoCurrency(): ?Currency
    {
        return $this->intoCurrency;
    }

    public function setIntoCurrency(?Currency $intoCurrency): self
    {
        $this->intoCurrency = $intoCurrency;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }
}
