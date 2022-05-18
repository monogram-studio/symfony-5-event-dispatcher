<?php declare(strict_types=1);

namespace App\Event;

use App\Model\Order;
use Symfony\Contracts\EventDispatcher\Event;

class OrderPlacedEvent extends Event
{
    public const NAME = 'order.placed';

    public function __construct(protected readonly Order $order)
    {}

    public function getOrder(): Order
    {
        return $this->order;
    }
}