<?php

namespace App\Entity;

use App\Repository\UploadsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UploadsRepository::class)]
class Uploads
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'uploads')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $upload_user_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $upload_date = null;

    #[ORM\Column(length: 255)]
    private ?string $upload_fichier = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUploadUserId(): ?User
    {
        return $this->upload_user_id;
    }

    public function setUploadUserId(?User $upload_user_id): static
    {
        $this->upload_user_id = $upload_user_id;

        return $this;
    }

    public function getUploadDate(): ?\DateTimeInterface
    {
        return $this->upload_date;
    }

    public function setUploadDate(\DateTimeInterface $upload_date): static
    {
        $this->upload_date = $upload_date;

        return $this;
    }

    public function getUploadFichier(): ?string
    {
        return $this->upload_fichier;
    }

    public function setUploadFichier(string $upload_fichier): static
    {
        $this->upload_fichier = $upload_fichier;

        return $this;
    }
}
