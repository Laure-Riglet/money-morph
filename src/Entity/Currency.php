<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    #[ORM\Id]
    #[ORM\Column(length: 3)]
    #[Groups(['rate'])]
    private ?string $id;

    #[ORM\Column(length: 64)]
    #[Groups(['rate'])]
    private ?string $name;

    #[ORM\Column(length: 2, nullable: true)]
    #[Groups(['rate'])]
    private ?string $symbol;

    #[ORM\Column]
    #[Groups(['rate'])]
    private ?string $svgflag;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): Currency
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(?string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }
}
