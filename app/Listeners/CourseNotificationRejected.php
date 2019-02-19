<?php

namespace App\Listeners;

use App\Events\AdminCurseStatusRejectMessage;
use App\Mail\CourseRejected;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CourseNotificationRejected implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(AdminCurseStatusRejectMessage $event)
    {
        $job = (\Mail::to($event->course->teacher->user)->send(new CourseRejected($event->course)));
        $this->dispatch($job);
    }
}
