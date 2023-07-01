<?php

namespace App\Entity;

use App\Repository\PreInscriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=PreInscriptionRepository::class)
 */
class PreInscription {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $anneeUniv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placeOfBirth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etab;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bac;

    /**
     * @ORM\Column(type="boolean", options={"default" = false})
     */
    private $isAccepted;

    /**
     * @var \DateTime $created_at
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Speciality::class, inversedBy="preInscriptions")
     */
    private $speciality;

    /**
     * @ORM\ManyToOne(targetEntity=OpenPreInscription::class, inversedBy="preInscriptions")
     */
    private $openPreInscription;

    public function getId(): ?int {
        return $this->id;
    }

    public function getAnneeUniv(): ?int {
        return $this->anneeUniv;
    }

    public function setAnneeUniv(int $anneeUniv): self {
        $this->anneeUniv = $anneeUniv;

        return $this;
    }


    public function isIsAccepted(): ?bool {
        return $this->isAccepted;
    }

    public function setIsAccepted(bool $isAccepted): self {
        $this->isAccepted = $isAccepted;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface {
        return $this->createdAt;
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

    public function getBirthdate(): ?\DateTimeInterface {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;

        return $this;
    }

    public function getAdress(): ?string {
        return $this->adress;
    }

    public function setAdress(string $adress): self {
        $this->adress = $adress;

        return $this;
    }

    public function getPhone(): ?string {
        return $this->phone;
    }

    public function setPhone(string $phone): self {
        $this->phone = $phone;

        return $this;
    }

    public function getEtab(): ?string {
        return $this->etab;
    }

    public function setEtab(string $etab): self {
        $this->etab = $etab;

        return $this;
    }

    public function getBac(): ?string {
        return $this->bac;
    }

    public function setBac(string $bac): self {
        $this->bac = $bac;

        return $this;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth(string $placeOfBirth): self
    {
        $this->placeOfBirth = $placeOfBirth;

        return $this;
    }

    public function getSpeciality(): ?Speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(?Speciality $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getOpenPreInscription(): ?OpenPreInscription
    {
        return $this->openPreInscription;
    }

    public function setOpenPreInscription(?OpenPreInscription $openPreInscription): self
    {
        $this->openPreInscription = $openPreInscription;

        return $this;
    }

}
