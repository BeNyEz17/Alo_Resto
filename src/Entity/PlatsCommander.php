<?php

namespace App\Entity;

use App\Repository\PlatsCommanderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlatsCommanderRepository::class)
 */
class PlatsCommander
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Livraison::class, inversedBy="platsCommanders")
     */
    private $fk_livraisons;

    /**
     * @ORM\ManyToOne(targetEntity=Plat::class, inversedBy="platsCommanders")
     */
    private $fk_plats;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkLivraisons(): ?Livraison
    {
        return $this->fk_livraisons;
    }

    public function setFkLivraisons(?Livraison $fk_livraisons): self
    {
        $this->fk_livraisons = $fk_livraisons;

        return $this;
    }

    public function getFkPlats(): ?Plat
    {
        return $this->fk_plats;
    }

    public function setFkPlats(?Plat $fk_plats): self
    {
        $this->fk_plats = $fk_plats;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
