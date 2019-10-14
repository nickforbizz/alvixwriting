<?php

namespace App\Listeners;

use App\Mail\TakeOrder;
use App\Events\TakeOrderEvent;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderTakeNotifyAdminListener
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
     * @param  TakeOrderEvent  $event
     * @return void
     */
    public function handle(TakeOrderEvent $event)
    {
        // return $event->order->admin()->first()->email;

        Mail::to($event->order->admin()->first()->email)->locale('es')->send(
            new TakeOrder($event->order, $event->writer)
        );
    }
}
