<?php

namespace App\Model;

class Widget
{
    private $name;
    private $shortName;
    private $fqcn;
    private $config;

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

    public function setFqcn($fqcn)
    {
        $this->fqcn = $fqcn;

        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }
}