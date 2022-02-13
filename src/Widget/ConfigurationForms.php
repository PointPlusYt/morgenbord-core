<?php

namespace App\Widget;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactoryInterface;

class ConfigurationForms
{
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function createFormBuilder(): FormBuilder
    {
        return $this->formFactory->createBuilder();
    }

    public function createForm(string $configurationFormType, mixed $data = null, array $options = [])
    {
        $formFactory = $this->formFactory->create($configurationFormType, $data, $options);
    }
}