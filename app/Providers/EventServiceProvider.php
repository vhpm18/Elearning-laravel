<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\CourseWasCreated'              => [
            'App\Listeners\CourseNotificationCreated',
        ],
        'App\Events\AdminCurseStatusMessage'       => [
            'App\Listeners\CourseNotificationApproved',
        ],
        'App\Events\AdminCurseStatusRejectMessage' => [
            'App\Listeners\CourseNotificationRejected',
        ],
        'App\Events\SendMessageUser'               => [
            'App\Listeners\SendMessageNotificationUser',
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
