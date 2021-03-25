<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Content::class, mappedBy="tags")
     */
    private $contents;

    /**
     * @ORM\ManyToOne(targetEntity=TagType::class, inversedBy="tags")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tagType;

    public function __construct()
    {
        $this->contents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Content[]
     */
    public function getContents(): Collection
    {
        return $this->contents;
    }

    public function addContent(Content $content): self
    {
        if (!$this->contents->contains($content)) {
            $this->contents[] = $content;
            $content->addTag($this);
        }

        return $this;
    }

    public function removeContent(Content $content): self
    {
        if ($this->contents->removeElement($content)) {
            $content->removeTag($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->name;
    }

    public function getTagType(): ?TagType
    {
        return $this->tagType;
    }

    public function setTagType(?TagType $tagType): self
    {
        $this->tagType = $tagType;

        return $this;
    }
}
