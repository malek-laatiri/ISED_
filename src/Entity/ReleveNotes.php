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
     * @ORM\ManyToOne(targetEntity=Admission::class, inversedBy="notes")
     */
    private $admission;

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
}
