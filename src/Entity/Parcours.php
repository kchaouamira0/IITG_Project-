<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcoursRepository::class)
 */
class Parcours
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $abrv;

    /**
     * @ORM\OneToMany(targetEntity=Speciality::class, mappedBy="parcours")
     */
    private $specialities;

    /**
     * @ORM\OneToMany(targetEntity=FiliereByParcours::class, mappedBy="parcours")
     */
    private $filiereByParcours;

   

    public function __construct()
    {
        $this->specialities = new ArrayCollection();
        $this->filiereByParcours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAbrv(): ?string
    {
        return $this->abrv;
    }

    public function setAbrv(string $abrv): self
    {
        $this->abrv = $abrv;

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
            $speciality->setParcours($this);
        }

        return $this;
    }

    public function removeSpeciality(Speciality $speciality): self
    {
        if ($this->specialities->removeElement($speciality)) {
            // set the owning side to null (unless already changed)
            if ($speciality->getParcours() === $this) {
                $speciality->setParcours(null);
            }
        }

        return $this;
    }
      public function __toString() {
        return $this->name;
    }

      /**
       * @return Collection<int, FiliereByParcours>
       */
      public function getFiliereByParcours(): Collection
      {
          return $this->filiereByParcours;
      }

      public function addFiliereByParcour(FiliereByParcours $filiereByParcour): self
      {
          if (!$this->filiereByParcours->contains($filiereByParcour)) {
              $this->filiereByParcours[] = $filiereByParcour;
              $filiereByParcour->setParcours($this);
          }

          return $this;
      }

      public function removeFiliereByParcour(FiliereByParcours $filiereByParcour): self
      {
          if ($this->filiereByParcours->removeElement($filiereByParcour)) {
              // set the owning side to null (unless already changed)
              if ($filiereByParcour->getParcours() === $this) {
                  $filiereByParcour->setParcours(null);
              }
          }

          return $this;
      }

      
}
