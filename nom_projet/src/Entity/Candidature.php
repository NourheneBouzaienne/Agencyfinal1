<?php

namespace App\Entity;

use App\Repository\CandidatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CandidatureRepository::class)
 */
class Candidature
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
    private $nomcandidat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numerodetel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomcandidat(): ?string
    {
        return $this->nomcandidat;
    }

    public function setNomcandidat(string $nomcandidat): self
    {
        $this->nomcandidat = $nomcandidat;

        return $this;
    }

    public function getNumerodetel(): ?string
    {
        return $this->numerodetel;
    }

    public function setNumerodetel(string $numerodetel): self
    {
        $this->numerodetel = $numerodetel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function getetat(): ?string
    {
        return $this->etat;
    }

    public function setetat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
