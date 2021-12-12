<?php

namespace App\Service;

use App\Entity\UserWidget;
use App\Entity\Widget;
use Symfony\Component\Config\Definition\Processor;

class LoadWidget
{
    public function loadParameters($userParameters, Widget $widget, UserWidget $userWidget)
    {
        $processor = new Processor();

        $configurationFqcn = preg_replace('/Bundle$/', 'Configuration', $widget->getFqcn());
        $configurationTree = new $configurationFqcn();
        $processedConfiguration = $processor->processConfiguration($configurationTree, [$userParameters]);

        $userWidget->setParameters($processedConfiguration);
    }
}