<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Assignment;
use App\Notifications\NewOrder;

class OrderObserver 
{
    public function created(Assignment $order)
    {
        $writers = User::where('active', 1)>get();
        $publisher = $order->user;

        foreach ($writers as $writer) {
            $writer->notify(new NewOrder($publisher, $order));
        }
    }
}

?>