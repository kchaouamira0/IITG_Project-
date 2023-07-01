<?php

namespace App\Entity;

use App\Repository\InstitutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InstitutRepository::class)
 */
class Institut {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id = 1;    // Utilisation d'une clé primaire fixe

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;


    /**
     * @ORM\ManyToMany(targetEntity=Phone::class, inversedBy="instituts", cascade={"persist"})
     */
    private $phones;

    /**
     * @ORM\ManyToMany(targetEntity=Email::class, inversedBy="instituts", cascade={"persist"})
     */
    private $emails;

    public function __construct() {
        $this->phones = new ArrayCollection();
        $this->emails = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getAdress(): ?string {
        return $this->adress;
    }

    public function setAdress(string $adress): self {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection<int, Phone>
     */
    public function getPhones(): Collection {
        return $this->phones;
    }

    public function addPhone(Phone $phone): self {
        if (!$this->phones->contains($phone)) {
            $this->phones[] = $phone;
        }

        return $this;
    }

    public function removePhone(Phone $phone): self {
        $this->phones->removeElement($phone);

        return $this;
    }
    
    public function __toString() {
        return "iitg";
    }

    /**
     * @return Collection<int, Email>
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    public function addEmail(Email $email): self
    {
        if (!$this->emails->contains($email)) {
            $this->emails[] = $email;
        }

        return $this;
    }

    public function removeEmail(Email $email): self
    {
        $this->emails->removeElement($email);

        return $this;
    }

   

}
