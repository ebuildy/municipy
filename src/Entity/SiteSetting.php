<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiteSettingRepository")
 */
class SiteSetting
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
    private $domain;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $protocol;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $facebookPage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $twitterPage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $youtubePage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getProtocol(): ?string
    {
        return $this->protocol;
    }

    public function setProtocol(string $protocol): self
    {
        $this->protocol = $protocol;

        return $this;
    }

    public function getFacebookPage(): ?string
    {
        return $this->facebookPage;
    }

    public function setFacebookPage(?string $facebookPage): self
    {
        $this->facebookPage = $facebookPage;

        return $this;
    }

    public function getTwitterPage(): ?string
    {
        return $this->twitterPage;
    }

    public function setTwitterPage(?string $twitterPage): self
    {
        $this->twitterPage = $twitterPage;

        return $this;
    }

    public function getYoutubePage(): ?string
    {
        return $this->youtubePage;
    }

    public function setYoutubePage(?string $youtubePage): self
    {
        $this->youtubePage = $youtubePage;

        return $this;
    }
}
