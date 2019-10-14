<?php

namespace App\Listeners;

use App\Mail\OrderProgressMail;
use App\Events\OrderProgressEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WriterFinishedOrderListener
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
     * @param  OrderProgressEvent  $event
     * @return void
     */
    public function handle(OrderProgressEvent $event)
    {
        Mail::to($event->admin->email)->send(

            new OrderProgressMail($event->writer, $event->order, $event->admin)
            
        );
    }
}
