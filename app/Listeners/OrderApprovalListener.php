<?php

namespace App\Listeners;

use App\Events\OrderApprovalEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderApprovalRejectedMail;
use App\Mail\OrderApprovalConfirmedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderApprovalListener
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
     * @param  OrderApprovalEvent  $event
     * @return void
     */
    public function handle(OrderApprovalEvent $event)
    {
        if ($event->approval == 'confirmed') {
            
            Mail::to($event->writer->email)->send( 
                new OrderApprovalConfirmedMail($event->writer, $event->admin, $event->order)
            );

        } else {

            Mail::to($event->writer->email)->send(
                new OrderApprovalRejectedMail($event->writer, $event->admin, $event->order)
            );
            
        }
        
    }
}
