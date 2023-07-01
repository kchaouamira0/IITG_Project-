<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhoneRepository::class)
 */
class Phone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique="true")
     */
    private $number;

    /**
     * @ORM\ManyToMany(targetEntity=Institut::class, mappedBy="phones")
     */
    private $instituts;

    /**
     * @ORM\ManyToMany(targetEntity=Direction::class, mappedBy="phones")
     */
    private $directions;

   


    public function __construct()
    {
        $this->instituts = new ArrayCollection();
        $this->directions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection<int, Institut>
     */
    public function getInstituts(): Collection
    {
        return $this->instituts;
    }

    public function addInstitut(Institut $institut): self
    {
        if (!$this->instituts->contains($institut)) {
            $this->instituts[] = $institut;
            $institut->addPhone($this);
        }

        return $this;
    }

    public function removeInstitut(Institut $institut): self
    {
        if ($this->instituts->removeElement($institut)) {
            $institut->removePhone($this);
        }

        return $this;
    }

   
     
    public function __toString() {
        return $this->number;
    }

    /**
     * @return Collection<int, Direction>
     */
    public function getDirections(): Collection
    {
        return $this->directions;
    }

    public function addDirection(Direction $direction): self
    {
        if (!$this->directions->contains($direction)) {
            $this->directions[] = $direction;
            $direction->addPhone($this);
        }

        return $this;
    }

    public function removeDirection(Direction $direction): self
    {
        if ($this->directions->removeElement($direction)) {
            $direction->removePhone($this);
        }

        return $this;
    }

  
}
