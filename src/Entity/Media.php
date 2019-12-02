<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 */
class Media
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var UploadedFile|null
     * @Assert\Image
     * @Assert\NotNull(groups={"add"})
     */
    private $uploadedFile;


    /**
     * @var string|null
     * @ORM\Column(type="text")
     */
    private $uri;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_add;

    /**
     * @var Trick|null
     * @ORM\ManyToOne(targetEntity="App\Entity\Trick", inversedBy="medias")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $trick;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    /**
     * @param string|null $path
     */
    public function setUri(?string $uri): void
    {
        $this->uri = $uri;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->date_add;
    }

    public function setDateAdd(\DateTimeInterface $date_add): self
    {
        $this->date_add = $date_add;

        return $this;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): self
    {
        $this->trick = $trick;

        return $this;
    }

    /**
     * @return UploadedFile|null
     */
    public function getUploadedFile(): ?UploadedFile
    {
        return $this->uploadedFile;
    }

    /**
     * @param UploadedFile|null $uploadedFile
     */
    public function setUploadedFile(?UploadedFile $uploadedFile): void
    {
        $this->uploadedFile = $uploadedFile;
    }
}
