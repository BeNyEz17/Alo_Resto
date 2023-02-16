<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
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
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="restaurants")
     */
    private $fk_user;

    /**
     * @ORM\OneToMany(targetEntity=Livraison::class, mappedBy="fk_restaurant")
     */
    private $livraisons;

    /**
     * @ORM\ManyToOne(targetEntity=Secteurlivraison::class, inversedBy="restaurants")
     */
    private $fk_secteur_livraison;

    /**
     * @ORM\ManyToMany(targetEntity=Plat::class, inversedBy="restaurants")
     */
    private $Plats;

    public function __construct()
    {
        $this->livraisons = new ArrayCollection();
        $this->Plats = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->id .'-' . $this->getNom();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getFkUser(): ?User
    {
        return $this->fk_user;
    }

    public function setFkUser(?User $fk_user): self
    {
        $this->fk_user = $fk_user;

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons[] = $livraison;
            $livraison->setFkRestaurant($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getFkRestaurant() === $this) {
                $livraison->setFkRestaurant(null);
            }
        }

        return $this;
    }

    public function getFkSecteurLivraison(): ?Secteurlivraison
    {
        return $this->fk_secteur_livraison;
    }

    public function setFkSecteurLivraison(?Secteurlivraison $fk_secteur_livraison): self
    {
        $this->fk_secteur_livraison = $fk_secteur_livraison;

        return $this;
    }

    /**
     * @return Collection<int, Plat>
     */
    public function getPlats(): Collection
    {
        return $this->Plats;
    }

    public function addPlat(Plat $plat): self
    {
        if (!$this->Plats->contains($plat)) {
            $this->Plats[] = $plat;
        }

        return $this;
    }

    public function removePlat(Plat $plat): self
    {
        $this->Plats->removeElement($plat);

        return $this;
    }
}
