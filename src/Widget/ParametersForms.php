<?php

namespace App\Widget;

use App\Entity\UserWidget;
use App\Entity\Widget;
use Symfony\Component\Form\FormFactoryInterface;

class ParametersForms
{
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function getForm(Widget $widget)
    {
        $configurationFqcn = $this->getParametersFqcnFromWidget($widget);
        return $this->getFormFromFqcn($configurationFqcn);
    }

    public function getFormFromFqcn(string $configurationFqcn)
    {
        $formBuilder = $this->formFactory->createBuilder();
        $config = new $configurationFqcn();
        $config->createParametersForm($formBuilder);

        return $formBuilder->getForm();
    }

    public function getParametersFqcnFromWidget(Widget $widget)
    {
        return preg_replace('/Bundle$/', 'Parameters', $widget->getFqcn());
    }

    /**
     * Load widget parameters into the UserWidget
     *
     * @param Widget $widget Widget to load parameters for
     * @param UserWidget $userWidget UserWidget to set parameters in
     * @param array $userParameters User parameters to merge with default parameter values
     * @return void
     */
    public function loadParameters(Widget $widget, UserWidget $userWidget, array $userParameters)
    {
        $configurationFqcn = $this->getParametersFqcnFromWidget($widget);
        $config = $this->processParameters($configurationFqcn, $userParameters);
        
        $userWidget->setParameters($config);
    }
    
    public function processParameters(string $configurationFqcn, array $userParameters)
    {
        $form = $this->getFormFromFqcn($configurationFqcn);
        $form->submit($userParameters);
        return $form->getData();
    }
}