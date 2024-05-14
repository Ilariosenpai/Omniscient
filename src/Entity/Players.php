<?php

namespace App\Entity;

use App\Repository\PlayersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayersRepository::class)]
class Players
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

   

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $image = null;

    #[ORM\ManyToOne(inversedBy: 'players')]
    private ?Games $game = null;

    #[ORM\Column(length: 255)]
    private ?string $palmares = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

   

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getGame(): ?Games
    {
        return $this->game;
    }

    public function setGame(?Games $game): static
    {
        $this->game = $game;

        return $this;
    }

    public function getPalmares(): ?string
    {
        return $this->palmares;
    }

    public function setPalmares(string $palmares): static
    {
        $this->palmares = $palmares;

        return $this;
    }
}
