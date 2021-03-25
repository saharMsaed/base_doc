<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContentRepository::class)
 */
class Content
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
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $abstract;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $keywords;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="editorContents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $editor;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="providerContents")
     */
    private $providers;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="contents")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity=ContentType::class, inversedBy="contents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contentType;

    /**
     * @ORM\OneToMany(targetEntity=Sheet::class, mappedBy="content")
     */
    private $sheets;


    public function __construct()
    {
        $this->providers = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->sheets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(?string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getEditor(): ?User
    {
        return $this->editor;
    }

    public function setEditor(?User $editor): self
    {
        $this->editor = $editor;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getProviders(): Collection
    {
        return $this->providers;
    }

    public function addProvider(User $provider): self
    {
        if (!$this->providers->contains($provider)) {
            $this->providers[] = $provider;
        }

        return $this;
    }

    public function removeProvider(User $provider): self
    {
        $this->providers->removeElement($provider);

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getContentType(): ?ContentType
    {
        return $this->contentType;
    }

    public function setContentType(?ContentType $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * @return Collection|Sheet[]
     */
    public function getSheets(): Collection
    {
        return $this->sheets;
    }

    public function addSheet(Sheet $sheet): self
    {
        if (!$this->sheets->contains($sheet)) {
            $this->sheets[] = $sheet;
            $sheet->setContent($this);
        }

        return $this;
    }

    public function removeSheet(Sheet $sheet): self
    {
        if ($this->sheets->removeElement($sheet)) {
            // set the owning side to null (unless already changed)
            if ($sheet->getContent() === $this) {
                $sheet->setContent(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->title;
    }

}
