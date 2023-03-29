<?php 

namespace App\EventSubscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class CustomEventsubscriber implements EventSubscriberInterface
{

    public function __construct(private readonly LoggerInterface $logger)
    {

    }

    public static function getSubscribedEvents(): array
    {
       return [
          KernelEvents::RESPONSE => [
            ['onPreResponseEvent'],
            ['onPostResponseEvent',10] //ajout de la priorité sachant que a la base les priorité sont a 0
          ]
       ];
    }

    public function onPreResponseEvent(ResponseEvent $event): void
    {
    //    dd($event);
    $this->logger->info(__METHOD__);
    }

    public function onPostResponseEvent(ResponseEvent $event): void
    {
    //    dd($event);
    $this->logger->info(__METHOD__);
    }
}