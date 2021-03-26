<?php

namespace App\Entity;

use App\Repository\DiplomeRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=DiplomeRepository::class)
 * @Vich\Uploadable
 */
class Diplome
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Admission::class, inversedBy="diplomes")
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
