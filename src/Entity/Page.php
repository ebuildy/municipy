<?php

namespace App\Entity;

use App\Entity\Behavior\WithTimestamp;
use App\Utils\StringUtils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Behavior\TimestampableTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Page
{
    use WithTimestamp;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $template;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Page", inversedBy="children")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Page", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $generator;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->createdat = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdateHook()
    {
        $this->updatedAt = new \DateTime();

        $this->fixName();
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersistHook()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();

        $this->fixName();
    }

    public function fixName() {
        if (strpos($this->name, 'cms_') === false) {
            $this->name = 'cms_' . $this->name;
        }

        $this->name = StringUtils::toSnakeCase($this->name);
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(?string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(self $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getGenerator(): ?string
    {
        return $this->generator;
    }

    public function setGenerator(?string $generator): self
    {
        $this->generator = $generator;

        return $this;
    }


    public function __toString(): string {
      return $this->name ?? "";
    }
}
