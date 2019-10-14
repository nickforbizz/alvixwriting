<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\SubscribeEvent' => [
            'App\Listeners\SubscribeListener',
        ],
        'App\Events\TakeOrderEvent' => [
            'App\Listeners\OrderTakeNotifyAdminListener',
        ],

        'App\Events\OrderProgressEvent' => [
            'App\Listeners\WriterFinishedOrderListener',
            
        ],

        'App\Events\OrderReviewProgressEvent' => [
            'App\Listeners\WriterFinishedReviewOrderListener',
          
        ],

        'App\Events\OrderApprovalEvent' => [
            'App\Listeners\OrderApprovalListener',
          
        ],
        
    
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
