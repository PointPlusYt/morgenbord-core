<?php

namespace App\Event;

use App\Model\Widget;
use Symfony\Contracts\EventDispatcher\Event;

class RegisterWidgetEvent extends Event
{
    const NAME = 'morning_bord.register_widget';

    private $widgets = [];

    public function getWidgets(): array
    {
        return $this->widgets;
    }

    public function addWidget(Widget $widget)
    {
        // TODO : check if widget is already registered
        $this->widgets[$widget->getShortName()] = $widget;
    }

    public function removeWidget(Widget $widget)
    {
        $key = array_search($widget, $this->widgets);
        if ($key !== false) {
            unset($this->widgets[$key]);
        }
    }
}