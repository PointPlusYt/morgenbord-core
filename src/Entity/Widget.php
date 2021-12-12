<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\MappedSuperclass
 */
class Widget
{
    /**
     * @Groups({"read"})
     */
    private $name;

    /**
     * @Groups({"read"})
     */
    private $shortName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $fqcn;

    /**
     * @ORM\Column(type="json")
     * @Groups({"read"})
     */
    private $parameters;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getShortName()
    {
        return $this->shortName;
    }

    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getFqcn()
    {
        return $this->fqcn;
    }

    /**
     * Returns the name of the bundle in the \@NameOfBundle format,
     * based on the FQCN
     *
     * @return string
     */
    public function getAtName(): string
    {
        return preg_replace('/(.+)\\\\(\w+)Bundle$/', '@${2}', $this->fqcn);
    }

    public function setFqcn($fqcn)
    {
        $this->fqcn = $fqcn;

        return $this;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }
}