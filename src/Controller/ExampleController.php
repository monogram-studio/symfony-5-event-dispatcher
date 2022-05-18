<?php declare(strict_types=1);

namespace App\Controller;

use App\Event\OrderPlacedEvent;
use App\Model\Order;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExampleController extends AbstractController
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
    ){}

    #[Route(path: '/', name: 'app.example.index')]
    public function index(): Response
    {
        $order = (new Order())
            ->setId(rand(1,100000))
            ->setCustomerEmail('lorem.ispum@example.com')
            ->setStatus('placed')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
        ;

        $orderPlacedEvent = new OrderPlacedEvent($order);
        $this->eventDispatcher->dispatch($orderPlacedEvent, OrderPlacedEvent::NAME);
        return new Response(sprintf(
            'Order %d was placed and it’s logged thanks to App\\EventSubscriber\\OrderPlacedSubscriber',
            $order->getId()
        ));
    }
}