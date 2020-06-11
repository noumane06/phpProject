<?php

namespace App\Entity;

use App\Repository\DepartementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartementsRepository::class)
 */
class Departements
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_dep;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $professeur;

    /**
     * @ORM\OneToMany(targetEntity=Professeur::class, mappedBy="departements")
     */
    private $Prof;

    public function __construct()
    {
        $this->Prof = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDep(): ?string
    {
        return $this->nom_dep;
    }

    public function setNomDep(string $nom_dep): self
    {
        $this->nom_dep = $nom_dep;

        return $this;
    }

    public function getProfesseur(): ?string
    {
        return $this->professeur;
    }

    public function setProfesseur(string $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    /**
     * @return Collection|Professeur[]
     */
    public function getProf(): Collection
    {
        return $this->Prof;
    }

    public function addProf(Professeur $prof): self
    {
        if (!$this->Prof->contains($prof)) {
            $this->Prof[] = $prof;
            $prof->setDepartements($this);
        }

        return $this;
    }

    public function removeProf(Professeur $prof): self
    {
        if ($this->Prof->contains($prof)) {
            $this->Prof->removeElement($prof);
            // set the owning side to null (unless already changed)
            if ($prof->getDepartements() === $this) {
                $prof->setDepartements(null);
            }
        }

        return $this;
    }


}
