<?php declare(strict_types=1);

namespace App\EventSubscriber;

use App\Event\OrderPlacedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OrderPlacedSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly LoggerInterface $logger
    ){}

    public static function getSubscribedEvents(): array
    {
        return [
            OrderPlacedEvent::NAME => 'onOrderPlaced',
        ];
    }

    public function onOrderPlaced(OrderPlacedEvent $orderPlacedEvent)
    {
        $this->logger->info(sprintf(
            'Order id %d was just placed.',
            $orderPlacedEvent->getOrder()->getId()
        ));
    }
}