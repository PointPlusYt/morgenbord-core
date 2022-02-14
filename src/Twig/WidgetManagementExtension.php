<?php

namespace App\Twig;

use App\Entity\UserWidget;
use App\Entity\Widget;
use App\Widget\ParametersForms;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class WidgetManagementExtension extends AbstractExtension
{
    private $parametersForms;

    public function __construct(ParametersForms $parametersForms)
    {
        $this->parametersForms = $parametersForms;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('get_actual_parameters', [$this, 'getActualParameters']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_widget_form', [$this, 'getWidgetForm']),
        ];
    }

    public function getWidgetForm(Widget $widget)
    {
        return $this->parametersForms->getForm($widget, true)->createView();
    }

    public function getActualParameters(UserWidget $widget)
    {
        $configurationFqcn = $this->parametersForms->getParametersFqcnFromWidget($widget);
        return $this->parametersForms->processParameters($configurationFqcn, $widget->getParameters());
    }
}
