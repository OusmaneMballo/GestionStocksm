<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SortieRepository::class)
 */
class Sortie
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
    private $sortie_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $qteS;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="sortie")
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sorties")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSortieAt(): ?\DateTimeInterface
    {
        return $this->sortie_at;
    }

    public function setSortieAt(\DateTimeInterface $sortie_at): self
    {
        $this->sortie_at = $sortie_at;

        return $this;
    }

    public function getQteS(): ?int
    {
        return $this->qteS;
    }

    public function setQteS(int $qteS): self
    {
        $this->qteS = $qteS;

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
