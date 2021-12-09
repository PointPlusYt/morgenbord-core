<?php

namespace App\EventSubscriber;

use App\Event\RegisterWidgetEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RequestSubscriber implements EventSubscriberInterface
{
    public $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        // $request->widgets = [];

        $registerWidgetEvent = new RegisterWidgetEvent();

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
