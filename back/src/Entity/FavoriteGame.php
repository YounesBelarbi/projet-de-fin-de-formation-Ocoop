<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavoriteGameRepository")
 */
class FavoriteGame
{
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rank", inversedBy="favoriteGames")
     */
    private $rank;

    /**
     * @ORM\Id @ORM\ManyToOne(targetEntity="App\Entity\Game", inversedBy="favoriteGames")
     */
    private $game;

    /**
     * @ORM\Id @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="favoriteGames")
     */
    private $user;


    public function __construct()
    {
        $this->games = new ArrayCollection();
    }


    public function getRank(): ?Rank
    {
        return $this->rank;
    }

    public function setRank(?Rank $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

}
