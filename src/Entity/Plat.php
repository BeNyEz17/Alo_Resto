<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlatRepository::class)
 */
class Plat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $tarif;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity=Typeplat::class, inversedBy="plats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fk_type_plat;

    /**
     * @ORM\ManyToMany(targetEntity=Restaurant::class, mappedBy="Plats")
     */
    private $restaurants;

    /**
     * @ORM\OneToMany(targetEntity=PlatsCommander::class, mappedBy="fk_plats")
     */
    private $platsCommanders;


    public function __construct()
    {
        $this->restaurants = new ArrayCollection();
        $this->platsCommanders = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getFkTypePlat(): ?typeplat
    {
        return $this->fk_type_plat;
    }

    public function setFkTypePlat(?typeplat $fk_type_plat): self
    {
        $this->fk_type_plat = $fk_type_plat;

        return $this;
    }

    /**
     * @return Collection<int, Restaurant>
     */
    public function getRestaurants(): Collection
    {
        return $this->restaurants;
    }

    public function addRestaurant(Restaurant $restaurant): self
    {
        if (!$this->restaurants->contains($restaurant)) {
            $this->restaurants[] = $restaurant;
            $restaurant->addPlat($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurant $restaurant): self
    {
        if ($this->restaurants->removeElement($restaurant)) {
            $restaurant->removePlat($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PlatsCommander>
     */
    public function getPlatsCommanders(): Collection
    {
        return $this->platsCommanders;
    }

    public function addPlatsCommander(PlatsCommander $platsCommander): self
    {
        if (!$this->platsCommanders->contains($platsCommander)) {
            $this->platsCommanders[] = $platsCommander;
            $platsCommander->setFkPlats($this);
        }

        return $this;
    }

    public function removePlatsCommander(PlatsCommander $platsCommander): self
    {
        if ($this->platsCommanders->removeElement($platsCommander)) {
            // set the owning side to null (unless already changed)
            if ($platsCommander->getFkPlats() === $this) {
                $platsCommander->setFkPlats(null);
            }
        }

        return $this;
    }
}
