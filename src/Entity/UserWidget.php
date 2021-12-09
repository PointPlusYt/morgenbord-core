<?php

namespace App\Entity;

use App\Repository\UserWidgetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserWidgetRepository::class)
 */
class UserWidget
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
    private $widgetFqcn;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userWidgets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\Column(type="json")
     */
    private $config = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWidgetFqcn(): ?string
    {
        return $this->widgetFqcn;
    }

    public function setWidgetFqcn(string $widgetFqcn): self
    {
        $this->widgetFqcn = $widgetFqcn;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getConfig(): ?array
    {
        return $this->config;
    }

    public function setConfig(array $config): self
    {
        $this->config = $config;

        return $this;
    }
}
