<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DispoRepository")
 */
class Dispo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lundi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mardi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mercredi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jeudi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vendredi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $samedi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dimanche;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="dispos", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLundi(): ?string
    {
        return $this->lundi;
    }

    public function setLundi(string $lundi): self
    {
        $this->lundi = $lundi;

        return $this;
    }

    public function getMardi(): ?string
    {
        return $this->mardi;
    }

    public function setMardi(string $mardi): self
    {
        $this->mardi = $mardi;

        return $this;
    }

    public function getMercredi(): ?string
    {
        return $this->mercredi;
    }

    public function setMercredi(string $mercredi): self
    {
        $this->mercredi = $mercredi;

        return $this;
    }

    public function getJeudi(): ?string
    {
        return $this->jeudi;
    }

    public function setJeudi(string $jeudi): self
    {
        $this->jeudi = $jeudi;

        return $this;
    }

    public function getVendredi(): ?string
    {
        return $this->vendredi;
    }

    public function setVendredi(string $vendredi): self
    {
        $this->vendredi = $vendredi;

        return $this;
    }

    public function getSamedi(): ?string
    {
        return $this->samedi;
    }

    public function setSamedi(string $samedi): self
    {
        $this->samedi = $samedi;

        return $this;
    }

    public function getDimanche(): ?string
    {
        return $this->dimanche;
    }

    public function setDimanche(string $dimanche): self
    {
        $this->dimanche = $dimanche;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
