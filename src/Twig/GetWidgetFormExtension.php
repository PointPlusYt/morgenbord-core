<?php

namespace App\Twig;

use App\Entity\Widget;
use App\Widget\ParametersForms;
use Twig\Extension\AbstractExtension;
// use Twig\TwigFilter;
use Twig\TwigFunction;

class GetWidgetFormExtension extends AbstractExtension
{
    private $parametersForms;

    public function __construct(ParametersForms $parametersForms)
    {
        $this->parametersForms = $parametersForms;
    }

    // public function getFilters(): array
    // {
    //     return [
    //         // If your filter generates SAFE HTML, you should add a third
    //         // parameter: ['is_safe' => ['html']]
    //         // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
    //         new TwigFilter('filter_name', [$this, 'doSomething']),
    //     ];
    // }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_widget_form', [$this, 'getWidgetForm']),
        ];
    }

    public function getWidgetForm(Widget $widget)
    {
        return $this->parametersForms->getForm($widget)->createView();
    }
}
