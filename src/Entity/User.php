<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="L'email est déjà utilisé par un autre utilisateur"
 * )
 */
class User implements UserInterface
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire au minimum 8 caractères !")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message ="Les mots de passe ne sont pas identiques")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_At;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grade;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Details", mappedBy="user", cascade={"persist", "remove"})
     */
    private $details;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sport", mappedBy="user")
     */
    private $sports;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Dispo", mappedBy="user", cascade={"persist", "remove"})
     */
    private $dispos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Conversation", mappedBy="userOne", orphanRemoval=true)
     */
    private $conversations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Conversation", mappedBy="userTwo")
     */
    private $partConversations;


    public function __construct()
    {
        $this->sports = new ArrayCollection();
        $this->conversations = new ArrayCollection();
        $this->partConversations = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_At;
    }

    public function setCreateAt(\DateTimeInterface $create_At): self
    {
        $this->create_At = $create_At;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function eraseCredentials() {}

    public function getSalt() {}

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getDetails(): ?Details
    {
        return $this->details;
    }

    public function setDetails(Details $details): self
    {
        $this->details = $details;

        // set the owning side of the relation if necessary
        if ($this !== $details->getUser()) {
            $details->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Sport[]
     */
    public function getSports(): Collection
    {
        return $this->sports;
    }

    public function addSport(Sport $sport): self
    {
        if (!$this->sports->contains($sport)) {
            $this->sports[] = $sport;
            $sport->addUser($this);
        }

        return $this;
    }

    public function removeSport(Sport $sport): self
    {
        if ($this->sports->contains($sport)) {
            $this->sports->removeElement($sport);
            $sport->removeUser($this);
        }

        return $this;
    }

    public function getDispos(): ?Dispo
    {
        return $this->dispos;
    }

    public function setDispos(Dispo $dispos): self
    {
        $this->dispos = $dispos;

        // set the owning side of the relation if necessary
        if ($this !== $dispos->getUser()) {
            $dispos->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Conversation[]
     */
    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversation $conversation): self
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations[] = $conversation;
            $conversation->setUserOne($this);
        }

        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        if ($this->conversations->contains($conversation)) {
            $this->conversations->removeElement($conversation);
            // set the owning side to null (unless already changed)
            if ($conversation->getUserOne() === $this) {
                $conversation->setUserOne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Conversation[]
     */
    public function getPartConversations(): Collection
    {
        return $this->partConversations;
    }

    public function addPartConversation(Conversation $partConversation): self
    {
        if (!$this->partConversations->contains($partConversation)) {
            $this->partConversations[] = $partConversation;
            $partConversation->setUserTwo($this);
        }

        return $this;
    }

    public function removePartConversation(Conversation $partConversation): self
    {
        if ($this->partConversations->contains($partConversation)) {
            $this->partConversations->removeElement($partConversation);
            // set the owning side to null (unless already changed)
            if ($partConversation->getUserTwo() === $this) {
                $partConversation->setUserTwo(null);
            }
        }

        return $this;
    }

}
