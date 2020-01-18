<?php

namespace App\Entity;

use App\Entity\Behavior\WithTimestamp;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgramCategoryRepository")
 * @Vich\Uploadable()
 */
class ProgramCategory
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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="categories", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

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

    /**
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return ProgramCategory
     */
    public function setImage(string $image): ProgramCategory
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     * @return ProgramCategory
     */
    public function setImageFile(File $imageFile): ProgramCategory
    {
        $this->imageFile = $imageFile;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($imageFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }



    public function __toString(): string {
      return $this->title ?? "";
    }
}
