<?php

namespace App\Listeners;

use App\Models\Admin;
use App\Events\SubscribeEvent;
use App\Mail\UpdatesSubscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\DefaultNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribeListener
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
     * @param  SubscribeEvent  $event
     * @return void
     */
    public function handle(SubscribeEvent $event)
    {
        Mail::to($event->email)->send(new UpdatesSubscription($event->email));
        Admin::where('status', 1)->notify(new DefaultNotification());
        return 'This is a listener';
    }
}
