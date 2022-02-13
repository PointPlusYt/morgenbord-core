<?php

namespace App\Widget;

use App\Entity\UserWidget;
use App\Entity\Widget;
use Symfony\Component\Config\Definition\Processor;

class ParametersService
{
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
        $configurationFqcn = $this->getConfigurationFqcnFromWidget($widget);
        $processedConfiguration = $this->processConfiguration($configurationFqcn, $userParameters);
        $userWidget->setParameters($processedConfiguration);
    }

    /**
     * Takes the widget's configuration default values and merges them with array of parameters
     *
     * @param Widget $widget Widget to load parameters for
     * @param array $configurationToMerge Configuration to merge with default parameter values
     * @return array
     */
    public function processConfiguration(string $configurationFqcn, array $configurationToMerge = [])
    {
        $configurationTree = new $configurationFqcn();
        $processor = new Processor();
        // dd($configurationTree->getConfigTreeBuilder());
        $config = $processor->processConfiguration($configurationTree, ['widget_parameters' => $configurationToMerge]);

        return $config;
    }

    public function getConfigurationFqcnFromWidget(Widget $widget)
    {
        return preg_replace('/Bundle$/', 'Configuration', $widget->getFqcn());
    }
}