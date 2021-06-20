<?php

namespace App\Entity;

use App\Repository\RdvRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RdvRepository::class)
 */
class Rdv
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomCandidat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EmailCandidat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCandidat(): ?string
    {
        return $this->NomCandidat;
    }

    public function setNomCandidat(string $NomCandidat): self
    {
        $this->NomCandidat = $NomCandidat;

        return $this;
    }

    public function getEmailCandidat(): ?string
    {
        return $this->EmailCandidat;
    }

    public function setEmailCandidat(string $EmailCandidat): self
    {
        $this->EmailCandidat = $EmailCandidat;

        return $this;
    }
}
