<?php

namespace App\Entity;

use App\Repository\HeroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HeroRepository::class)
 */
class Hero
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
     * @ORM\Column(type="array")
     */
    private $powerstats = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alignment;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $base;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groupAffiliation;

    /**
     * @ORM\OneToOne(targetEntity=Ticket::class, mappedBy="hero", cascade={"persist", "remove"})
     */
    private $ticket;

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

    public function getPowerstats(): ?array
    {
        return $this->powerstats;
    }

    public function setPowerstats(array $powerstats): self
    {
        $this->powerstats = $powerstats;

        return $this;
    }

    public function getAlignment(): ?string
    {
        return $this->alignment;
    }

    public function setAlignment(string $alignment): self
    {
        $this->alignment = $alignment;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getBase(): ?string
    {
        return $this->base;
    }

    public function setBase(string $base): self
    {
        $this->base = $base;

        return $this;
    }

    public function getGroupAffiliation(): ?string
    {
        return $this->groupAffiliation;
    }

    public function setGroupAffiliation(string $groupAffiliation): self
    {
        $this->groupAffiliation = $groupAffiliation;

        return $this;
    }

    public function getTicket(): ?Ticket
    {
        return $this->ticket;
    }

    public function setTicket(Ticket $ticket): self
    {
        // set the owning side of the relation if necessary
        if ($ticket->getHero() !== $this) {
            $ticket->setHero($this);
        }

        $this->ticket = $ticket;

        return $this;
    }
}
