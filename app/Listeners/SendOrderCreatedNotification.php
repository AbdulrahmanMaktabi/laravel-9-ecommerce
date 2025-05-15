<?php

namespace App\Listeners;

use App\Events\OrderCreatedEvent;
use App\Notifications\OrderCreatdNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCreatedNotification
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreatedEvent $event)
    {
        $storeOwner = $event->getOrder()->store->user;
        $storeOwner->notify(new OrderCreatdNotification($event->getOrder()));

        $user = $event->getOrder()->user;
        $user->notify(new OrderCreatdNotification($event->getOrder()));
    }
}
