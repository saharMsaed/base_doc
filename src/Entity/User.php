<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Content::class, mappedBy="editor")
     */
    private $editorContents;

    /**
     * @ORM\ManyToMany(targetEntity=Content::class, mappedBy="providers")
     */
    private $providerContents;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    public function __construct()
    {
        $this->editorContents = new ArrayCollection();
        $this->providerContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * This method is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * This method is not needed for apps that do not check user passwords.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Content[]
     */
    public function getEditorContents(): Collection
    {
        return $this->editorContents;
    }

    public function addEditorContent(Content $editorContent): self
    {
        if (!$this->editorContents->contains($editorContent)) {
            $this->editorContents[] = $editorContent;
            $editorContent->setEditor($this);
        }

        return $this;
    }

    public function removeEditorContent(Content $editorContent): self
    {
        if ($this->editorContents->removeElement($editorContent)) {
            // set the owning side to null (unless already changed)
            if ($editorContent->getEditor() === $this) {
                $editorContent->setEditor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Content[]
     */
    public function getProviderContents(): Collection
    {
        return $this->providerContents;
    }

    public function addProviderContent(Content $providerContent): self
    {
        if (!$this->providerContents->contains($providerContent)) {
            $this->providerContents[] = $providerContent;
            $providerContent->addProvider($this);
        }

        return $this;
    }

    public function removeProviderContent(Content $providerContent): self
    {
        if ($this->providerContents->removeElement($providerContent)) {
            $providerContent->removeProvider($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->firstname.' '.$this->lastname;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }
}
