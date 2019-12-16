<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("game_information")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("game_information")
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("game_information")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("game_information")
     */
    private $poster;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("game_information")
     */
    private $logo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rank", mappedBy="games")
     */
    private $ranks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FavoriteGame", mappedBy="game")
     */
    private $favoriteGames;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Platform", inversedBy="games")
     */
    private $platform;

    public function __toString()
    {
        return $this->title;
    }


    public function __construct()
    {
        $this->ranks = new ArrayCollection();
        $this->favoriteGames = new ArrayCollection();
        $this->platform = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|Rank[]
     */
    public function getRanks(): Collection
    {
        return $this->ranks;
    }

    public function addRank(Rank $rank): self
    {
        if (!$this->ranks->contains($rank)) {
            $this->ranks[] = $rank;
            $rank->setGames($this);
        }

        return $this;
    }

    public function removeRank(Rank $rank): self
    {
        if ($this->ranks->contains($rank)) {
            $this->ranks->removeElement($rank);
            // set the owning side to null (unless already changed)
            if ($rank->getGames() === $this) {
                $rank->setGames(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FavoriteGame[]
     */
    public function getFavoriteGames(): Collection
    {
        return $this->favoriteGames;
    }

    public function addFavoriteGame(FavoriteGame $favoriteGame): self
    {
        if (!$this->favoriteGames->contains($favoriteGame)) {
            $this->favoriteGames[] = $favoriteGame;
            $favoriteGame->setGame($this);
        }

        return $this;
    }

    public function removeFavoriteGame(FavoriteGame $favoriteGame): self
    {
        if ($this->favoriteGames->contains($favoriteGame)) {
            $this->favoriteGames->removeElement($favoriteGame);
            // set the owning side to null (unless already changed)
            if ($favoriteGame->getGame() === $this) {
                $favoriteGame->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Platform[]
     */
    public function getPlatform(): Collection
    {
        return $this->platform;
    }

    public function addPlatform(Platform $platform): self
    {
        if (!$this->platform->contains($platform)) {
            $this->platform[] = $platform;
        }

        return $this;
    }

    public function removePlatform(Platform $platform): self
    {
        if ($this->platform->contains($platform)) {
            $this->platform->removeElement($platform);
        }

        return $this;
    }

}
