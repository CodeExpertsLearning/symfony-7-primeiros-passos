<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: 'events')]
class Event
{
    use TimestampableEntity;

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
    #[Gedmo\Slug(fields: ['title'])]
    private ?string $slug = null;

    #[ORM\Column]
    #[Constraints\NotBlank(message: 'Este campo é obrigatório')]
    private ?\DateTime $startEvent = null;

    #[ORM\Column]
    #[Constraints\NotBlank(message: 'Este campo é obrigatório')]
    #[Constraints\GreaterThanOrEqual(propertyPath: 'startEvent', message: 'Esta data deve ser maior que a Data de Inicio!')]
    private ?\DateTime $endEvent = null;

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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt = null): static
    {
        $this->createdAt = $createdAt ?? new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt = null): static
    {
        $this->updatedAt = $updatedAt ?? new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));

        return $this;
    }
}
