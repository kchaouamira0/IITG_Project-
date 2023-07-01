<?php

namespace App\Entity;

use App\Repository\EmailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EmailRepository::class)
 */
class Email {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $value;

    /**
     * @ORM\ManyToMany(targetEntity=Institut::class, mappedBy="emails")
     */
    private $instituts;

    /**
     * @ORM\ManyToMany(targetEntity=Direction::class, mappedBy="emails")
     */
    private $directions;

   

   

    public function __construct() {
        $this->instituts = new ArrayCollection();
        $this->directions = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getValue(): ?string {
        return $this->value;
    }

    public function setValue(string $value): self {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection<int, Institut>
     */
    public function getInstituts(): Collection {
        return $this->instituts;
    }

    public function addInstitut(Institut $institut): self {
        if (!$this->instituts->contains($institut)) {
            $this->instituts[] = $institut;
            $institut->addEmail($this);
        }

        return $this;
    }

    public function removeInstitut(Institut $institut): self {
        if ($this->instituts->removeElement($institut)) {
            $institut->removeEmail($this);
        }

        return $this;
    }

    
    public function __toString() {
        return $this->value;
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
            $direction->addEmail($this);
        }

        return $this;
    }

    public function removeDirection(Direction $direction): self
    {
        if ($this->directions->removeElement($direction)) {
            $direction->removeEmail($this);
        }

        return $this;
    }


}
