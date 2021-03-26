<?php

namespace App\Entity;

use App\Repository\AdmissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=AdmissionRepository::class)
 * @Vich\Uploadable
 */
class Admission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $demande_insc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bac;

    /**
     * @ORM\OneToMany(targetEntity=Diplome::class, mappedBy="admission")
     */
    private $diplomes;

    /**
     * @ORM\OneToMany(targetEntity=ReleveNotes::class, mappedBy="admission")
     */
    private $notes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $att_travail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $att_titulaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $autorisation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="admission")
     */
    private $user;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="cin")
     * @var File
     */
    private $cinFile;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="bac")
     * @var File
     */
    private $bacFile;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="att_travail")
     * @var File
     */
    private $att_travailFile;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="att_titulaire")
     * @var File
     */
    private $att_titulaireFile;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="autorisation")
     * @var File
     */
    private $autorisationFile;

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="cv")
     * @var File
     */
    private $cvFile;

    public function __construct()
    {
        $this->diplomes = new ArrayCollection();
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDemandeInsc(): ?bool
    {
        return $this->demande_insc;
    }

    public function setDemandeInsc(bool $demande_insc): self
    {
        $this->demande_insc = $demande_insc;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getBac(): ?string
    {
        return $this->bac;
    }

    public function setBac(string $bac): self
    {
        $this->bac = $bac;

        return $this;
    }

    /**
     * @return Collection|Diplome[]
     */
    public function getDiplomes(): Collection
    {
        return $this->diplomes;
    }

    public function addDiplome(Diplome $diplome): self
    {
        if (!$this->diplomes->contains($diplome)) {
            $this->diplomes[] = $diplome;
            $diplome->setAdmission($this);
        }

        return $this;
    }

    public function removeDiplome(Diplome $diplome): self
    {
        if ($this->diplomes->removeElement($diplome)) {
            // set the owning side to null (unless already changed)
            if ($diplome->getAdmission() === $this) {
                $diplome->setAdmission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ReleveNotes[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(ReleveNotes $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setAdmission($this);
        }

        return $this;
    }

    public function removeNote(ReleveNotes $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getAdmission() === $this) {
                $note->setAdmission(null);
            }
        }

        return $this;
    }

    public function getAttTravail(): ?string
    {
        return $this->att_travail;
    }

    public function setAttTravail(string $att_travail): self
    {
        $this->att_travail = $att_travail;

        return $this;
    }

    public function getAttTitulaire(): ?string
    {
        return $this->att_titulaire;
    }

    public function setAttTitulaire(string $att_titulaire): self
    {
        $this->att_titulaire = $att_titulaire;

        return $this;
    }

    public function getAutorisation(): ?string
    {
        return $this->autorisation;
    }

    public function setAutorisation(string $autorisation): self
    {
        $this->autorisation = $autorisation;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCinFile()
    {
        return $this->cinFile;
    }

    public function setCinFile( $cinFile)
    {
        $this->cinFile = $cinFile;

        return $this;
    }

    public function getBacFile()
    {
        return $this->bacFile;
    }

    public function setBacFile( $bacFile)
    {
        $this->bacFile = $bacFile;

        return $this;
    }

    public function getAttTravailFile()
    {
        return $this->att_travailFile;
    }

    public function setAttTravailFile( $att_travailFile)
    {
        $this->att_travailFile = $att_travailFile;

        return $this;
    }

    public function getAttTitulaireFile()
    {
        return $this->att_titulaireFile;
    }

    public function setAttTitulaireFile( $att_titulaireFile)
    {
        $this->att_titulaireFile = $att_titulaireFile;

        return $this;
    }

    public function getAutorisationFile()
    {
        return $this->autorisationFile;
    }

    public function setAutorisationFile( $autorisationFile)
    {
        $this->autorisationFile = $autorisationFile;

        return $this;
    }

    public function getCvFile()
    {
        return $this->cvFile;
    }

    public function setCvFile($cvFile)
    {
        $this->cvFile = $cvFile;

        return $this;
    }
}
