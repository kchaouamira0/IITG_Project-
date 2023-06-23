<?php

namespace App\Entity;

use App\Repository\FiliereByParcoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=FiliereByParcoursRepository::class)
 * @UniqueEntity(
 *     fields={"parcours", "filiere"},
 *     errorPath="filiere",
 *     message="This filiere is already in use on that parcours."
 * ) 
 */
class FiliereByParcours {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Parcours::class, inversedBy="filiereByParcours")
     */
    private $parcours;

    /**
     * @ORM\ManyToOne(targetEntity=Filiere::class, inversedBy="filiereByParcours")
     */
    private $filiere;

    /**
     * @ORM\OneToMany(targetEntity=Speciality::class, mappedBy="filiereByParcours")
     */
    private $specialities;

    public function __construct()
    {
        $this->specialities = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }


    public function getParcours(): ?Parcours {
        return $this->parcours;
    }

    public function setParcours(?Parcours $parcours): self {
        $this->parcours = $parcours;

        return $this;
    }

    public function getFiliere(): ?Filiere {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): self {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * @return Collection<int, Speciality>
     */
    public function getSpecialities(): Collection
    {
        return $this->specialities;
    }

    public function addSpeciality(Speciality $speciality): self
    {
        if (!$this->specialities->contains($speciality)) {
            $this->specialities[] = $speciality;
            $speciality->setFiliereByParcours($this);
        }

        return $this;
    }

    public function removeSpeciality(Speciality $speciality): self
    {
        if ($this->specialities->removeElement($speciality)) {
            // set the owning side to null (unless already changed)
            if ($speciality->getFiliereByParcours() === $this) {
                $speciality->setFiliereByParcours(null);
            }
        }

        return $this;
    }

    
    public function __toString() {
        return $this->filiere." > ".$this->parcours;
    }
    
}
