<?php

namespace App\Entity;

use App\Repository\AcademicYearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=AcademicYearRepository::class)
 * @UniqueEntity("value")
 * @UniqueEntity("name")
 */
class AcademicYear {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=4)
     */
    private $value;

    /**
     * @var bool
     *
     * @ORM\Column(name="current", type="boolean",nullable=true,options={"default":false})
     */
    private $current;

    /**
     * @ORM\OneToMany(targetEntity=OpenPreInscription::class, mappedBy="academicYear")
     */
    private $openPreInscriptions;

    public function __construct() {
        $this->openPreInscriptions = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return Collection<int, OpenPreInscription>
     */
    public function getOpenPreInscriptions(): Collection {
        return $this->openPreInscriptions;
    }

    public function addOpenPreInscription(OpenPreInscription $openPreInscription): self {
        if (!$this->openPreInscriptions->contains($openPreInscription)) {
            $this->openPreInscriptions[] = $openPreInscription;
            $openPreInscription->setAcademicYear($this);
        }

        return $this;
    }

    public function removeOpenPreInscription(OpenPreInscription $openPreInscription): self {
        if ($this->openPreInscriptions->removeElement($openPreInscription)) {
            // set the owning side to null (unless already changed)
            if ($openPreInscription->getAcademicYear() === $this) {
                $openPreInscription->setAcademicYear(null);
            }
        }

        return $this;
    }

    public function isCurrent(): ?bool {
        return $this->current;
    }

    public function setCurrent(?bool $current): self {
        $this->current = $current;

        return $this;
    }

    public function getValue(): ?int {
        return $this->value;
    }

    public function setValue(int $value): self {
        $this->value = $value;

        return $this;
    }

    public function __toString() {
        $yearAfter = $this->value+1;
        $year = $this->value . "-" . $yearAfter;
        return $year;
    }

}
