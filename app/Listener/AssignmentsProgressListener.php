<?php

namespace App\Listener;

use App\Events\Assignments;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignmentsProgressListener
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
     * @param  Assignments  $event
     * @return void
     */
    public function handle(Assignments $event)
    {
        //
    }
}
