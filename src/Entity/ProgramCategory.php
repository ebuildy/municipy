<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgramCategoryRepository")
 */
class ProgramCategory
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
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="smallint")
     */
    private $rank;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PunchLine", mappedBy="categories")
     */
    private $punchLines;

    public function __construct()
    {
        $this->punchLines = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * @return Collection|PunchLine[]
     */
    public function getPunchLines(): Collection
    {
        return $this->punchLines;
    }

    public function addPunchLine(PunchLine $punchLine): self
    {
        if (!$this->punchLines->contains($punchLine)) {
            $this->punchLines[] = $punchLine;
            $punchLine->addCategory($this);
        }

        return $this;
    }

    public function removePunchLine(PunchLine $punchLine): self
    {
        if ($this->punchLines->contains($punchLine)) {
            $this->punchLines->removeElement($punchLine);
            $punchLine->removeCategory($this);
        }

        return $this;
    }

    public function __toString(): string {
      return $this->title ?? "";
    }
}
