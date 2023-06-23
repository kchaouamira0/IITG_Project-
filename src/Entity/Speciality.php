<?php

namespace App\Entity;

use App\Repository\SpecialityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialityRepository::class)
 */
class Speciality {

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
     * @ORM\Column(type="string", length=255, nullable="true")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=FiliereByParcours::class, inversedBy="specialities")
     */
    private $filiereByParcours;

    /**
     * @ORM\OneToMany(targetEntity=PreInscription::class, mappedBy="speciality")
     */
    private $preInscriptions;

    public function __construct()
    {
        $this->preInscriptions = new ArrayCollection();
    }

    

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(string $description): self {
        $this->description = $description;

        return $this;
    }


    public function __toString() {
        return $this->name;
    }

    public function getFiliereByParcours(): ?FiliereByParcours
    {
        return $this->filiereByParcours;
    }

    public function setFiliereByParcours(?FiliereByParcours $filiereByParcours): self
    {
        $this->filiereByParcours = $filiereByParcours;

        return $this;
    }

    /**
     * @return Collection<int, PreInscription>
     */
    public function getPreInscriptions(): Collection
    {
        return $this->preInscriptions;
    }

    public function addPreInscription(PreInscription $preInscription): self
    {
        if (!$this->preInscriptions->contains($preInscription)) {
            $this->preInscriptions[] = $preInscription;
            $preInscription->setSpeciality($this);
        }

        return $this;
    }

    public function removePreInscription(PreInscription $preInscription): self
    {
        if ($this->preInscriptions->removeElement($preInscription)) {
            // set the owning side to null (unless already changed)
            if ($preInscription->getSpeciality() === $this) {
                $preInscription->setSpeciality(null);
            }
        }

        return $this;
    }

}
