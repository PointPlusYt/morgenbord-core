<?php

namespace App\EventSubscriber;

use App\Event\RegisterWidgetEvent;
use App\Widget\ParametersService;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RequestSubscriber implements EventSubscriberInterface
{
    public $eventDispatcher;
    private $widgetParametersService;

    public function __construct(EventDispatcherInterface $eventDispatcher, ParametersService $widgetParametersService)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->widgetParametersService = $widgetParametersService;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        // $request->widgets = [];

        $registerWidgetEvent = new RegisterWidgetEvent();
        $registerWidgetEvent->widgetParametersService = $this->widgetParametersService;

        $this->eventDispatcher->dispatch(
            $registerWidgetEvent,
            RegisterWidgetEvent::NAME
        );
        
        $request->widgets = $registerWidgetEvent->getWidgets();

    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 1000],
        ];
    }
}
