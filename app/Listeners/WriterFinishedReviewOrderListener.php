<?php

namespace App\Listeners;

use App\Mail\TakeOrder;
use Illuminate\Support\Facades\Mail;
use App\Events\OrderReviewProgressEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WriterFinishedReviewOrderListener
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
     * @param  OrderReviewProgressEvent  $event
     * @return void
     */
    public function handle(OrderReviewProgressEvent $event)
    {
        Mail::to($event->order->admin()->first()->email)->locale('es')->send(
            new TakeOrder($event->order, $event->writer)
        );
    }
}
