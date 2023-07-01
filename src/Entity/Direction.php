<?php

namespace App\Entity;

use App\Repository\DirectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @ORM\Entity(repositoryClass=DirectionRepository::class)
 */
class Direction {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id = 1;    // Utilisation d'une clé primaire fixe

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sign;

    /**
     * @ORM\Column(type="string")
     */
    private $imageProfile;

    /**
     * @ORM\ManyToMany(targetEntity=Email::class, inversedBy="directions",cascade={"persist"})
     */
    private $emails;

    /**
     * @ORM\ManyToMany(targetEntity=Phone::class, inversedBy="directions",cascade={"persist"})
     */
    private $phones;

   
public static function getInstance(EntityManagerInterface $entityManager): ?Direction
{
    return $entityManager->getRepository(Direction::class)->find(1);
}

    public function __construct()
    {
        $this->emails = new ArrayCollection();
        $this->phones = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(string $address): self {
        $this->address = $address;

        return $this;
    }

    public function getSign(): ?string {
        return $this->sign;
    }

    public function setSign(string $sign): self {
        $this->sign = $sign;

        return $this;
    }

    public function getImageProfile(): ?string {
        return $this->imageProfile;
    }

    public function setImageProfile(string $imageProfile): self {
        $this->imageProfile = $imageProfile;

        return $this;
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

    /**
     * @return Collection<int, Phone>
     */
    public function getPhones(): Collection
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): self
    {
        if (!$this->phones->contains($phone)) {
            $this->phones[] = $phone;
        }

        return $this;
    }

    public function removePhone(Phone $phone): self
    {
        $this->phones->removeElement($phone);

        return $this;
    }

  

}
