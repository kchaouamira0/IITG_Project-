<?php

namespace App\Entity;

use App\Repository\OpenPreInscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @ORM\Entity(repositoryClass=OpenPreInscriptionRepository::class)
 */
class OpenPreInscription {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=PreInscription::class, mappedBy="openPreInscription",cascade={"remove"})
     */
    private $preInscriptions;

    /**
     * @ORM\ManyToOne(targetEntity=AcademicYear::class, inversedBy="openPreInscriptions")
     */
    private $academicYear;

    /**
     * @var bool
     *
     * @ORM\Column(name="current", type="boolean",nullable=true,options={"default":false})
     */
    private $current;

    public function __construct() {
        $this->preInscriptions = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): self {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): self {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(string $description): self {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, PreInscription>
     */
    public function getPreInscriptions(): Collection {
        return $this->preInscriptions;
    }

    public function addPreInscription(PreInscription $preInscription): self {
        if (!$this->preInscriptions->contains($preInscription)) {
            $this->preInscriptions[] = $preInscription;
            $preInscription->setOpenPreInscription($this);
        }

        return $this;
    }

    public function removePreInscription(PreInscription $preInscription): self {
        if ($this->preInscriptions->removeElement($preInscription)) {
            // set the owning side to null (unless already changed)
            if ($preInscription->getOpenPreInscription() === $this) {
                $preInscription->setOpenPreInscription(null);
            }
        }

        return $this;
    }

    public function getAcademicYear(): ?AcademicYear {
        return $this->academicYear;
    }

    public function setAcademicYear(?AcademicYear $academicYear): self {
        $this->academicYear = $academicYear;

        return $this;
    }

    public function isCurrent(): ?bool {
        return $this->current;
    }

    public function setCurrent(?bool $current): self {
        $this->current = $current;

        return $this;
    }

    public static function getInstanceOfOpenPreInscriptionCurrent(EntityManagerInterface $entityManager): ?OpenPreInscription {
        return $entityManager->getRepository(OpenPreInscription::class)->findOneBy(['current' => true]);
    }

}
