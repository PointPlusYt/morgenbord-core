<?php

namespace App\Interfaces;

use Symfony\Component\Form\FormInterface;

interface ConfigurationFormTypeInterface
{
    public function createConfigForm(): ?FormInterface;
}