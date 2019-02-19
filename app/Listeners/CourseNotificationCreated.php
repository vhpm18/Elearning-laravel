<?php

namespace App\Listeners;

use App\Events\CourseWasCreated;
use App\Mail\NewStudentInCourse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CourseNotificationCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Handle the event.
     *
     * @param  CourseWasCreated  $event
     * @return void
     */
    public function handle(CourseWasCreated $event)
    {
        $job = (\Mail::to($event->course->teacher->user)->send(new NewStudentInCourse($event->course, $event->auth)));
        $this->dispatch($job);
    }
}
