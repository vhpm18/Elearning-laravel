<?php

namespace App\Listeners;

use App\Events\SendMessageUser;
use App\Mail\MessageToStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessageNotificationUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Handle the event.
     *
     * @param  SendMessageUser  $event
     * @return void
     */
    public function handle(SendMessageUser $event)
    {
        $job = (\Mail::to($event->user)
                ->send(new MessageToStudent($event->auth, $event->message)));
        $this->dispatch($job);
    }
}
