<?php

namespace App\Entity;

use App\Repository\ReleveNotesRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=ReleveNotesRepository::class)
 * @Vich\Uploadable
 */
class ReleveNotes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Admission::class, inversedBy="notes",cascade={"persist,delete"})
     */
    private $admission;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="name")
     * @var File
     */
    private $file;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdmission(): ?Admission
    {
        return $this->admission;
    }

    public function setAdmission(?Admission $admission): self
    {
        $this->admission = $admission;

        return $this;
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

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(string $file)
    {
        $this->file = $file;

        return $this;
    }
}
