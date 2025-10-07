<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;
#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: 'events')]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Constraints\NotBlank(message: 'Este campo é obrigatório')]
    #[Constraints\Length(max: 80, maxMessage: 'Este campo deve ter no máximo 80 caracteres!' )]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Constraints\NotBlank(message: 'Este campo é obrigatório')]
    private ?string $body = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Constraints\NotBlank(message: 'Este campo é obrigatório')]
    private ?string $slug = null;

    #[ORM\Column]
    #[Constraints\NotBlank(message: 'Este campo é obrigatório')]
    private ?\DateTime $startEvent = null;

    #[ORM\Column]
    #[Constraints\NotBlank(message: 'Este campo é obrigatório')]
    private ?\DateTime $endEvent = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getStartEvent(): ?\DateTime
    {
        return $this->startEvent;
    }

    public function setStartEvent(?\DateTime $startEvent): static
    {
        $this->startEvent = $startEvent;

        return $this;
    }

    public function getEndEvent(): ?\DateTime
    {
        return $this->endEvent;
    }

    public function setEndEvent(?\DateTime $endEvnt): static
    {
        $this->endEvent = $endEvnt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt = null): static
    {
        $this->createdAt = $createdAt ?? new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo'));

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt = null): static
    {
        $this->updatedAt = $updatedAt ?? new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo'));

        return $this;
    }
}
