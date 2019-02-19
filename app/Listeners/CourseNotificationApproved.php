<?php

namespace App\Listeners;

use App\Events\AdminCurseStatusMessage;
use App\Listeners\CourseNotificationApproved;
use App\Mail\CourseApproved;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CourseNotificationApproved implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Handle the event.
     *
     * @param  AdminCurseStatusMessage  $event
     * @return void
     */
    public function handle(AdminCurseStatusMessage $event)
    {
        $job = (\Mail::to($event->course->teacher->user)->send(new CourseApproved($event->course)));
        $this->dispatch($job);
    }
}
