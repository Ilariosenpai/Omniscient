<?php

namespace App\Entity;

use App\Repository\GamesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GamesRepository::class)]
class Games
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $plateform = null;

    

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $image = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Players $player = null;

    /**
     * @var Collection<int, Players>
     */
    #[ORM\OneToMany(targetEntity: Players::class, mappedBy: 'game')]
    private Collection $players;

    /**
     * @var Collection<int, players>
     */
    #[ORM\ManyToMany(targetEntity: players::class, inversedBy: 'games')]
    private Collection $player_id;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->player_id = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPlateform(): ?string
    {
        return $this->plateform;
    }

    public function setPlateform(string $plateform): static
    {
        $this->plateform = $plateform;

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

    public function getPlayer(): ?Players
    {
        return $this->player;
    }

    public function setPlayer(?Players $player): static
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @return Collection<int, Players>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Players $player): static
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
            $player->setGame($this);
        }

        return $this;
    }

    public function removePlayer(Players $player): static
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getGame() === $this) {
                $player->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, players>
     */
    public function getPlayerId(): Collection
    {
        return $this->player_id;
    }

    public function addPlayerId(players $playerId): static
    {
        if (!$this->player_id->contains($playerId)) {
            $this->player_id->add($playerId);
        }

        return $this;
    }

    public function removePlayerId(players $playerId): static
    {
        $this->player_id->removeElement($playerId);

        return $this;
    }
}
