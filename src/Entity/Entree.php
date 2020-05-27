<?php

namespace App\Entity;

use App\Repository\EntreeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntreeRepository::class)
 */
class Entree
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $entrer_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $qtE;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="entree")
     */
    private $produit;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntrerAt(): ?\DateTimeInterface
    {
        return $this->entrer_at;
    }

    public function setEntrerAt(\DateTimeInterface $entrer_at): self
    {
        $this->entrer_at = $entrer_at;

        return $this;
    }

    public function getQtE(): ?int
    {
        return $this->qtE;
    }

    public function setQtE(int $qtE): self
    {
        $this->qtE = $qtE;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

}
