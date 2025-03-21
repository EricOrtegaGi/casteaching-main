<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendVideoCreatedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Notification::route('mail', config('casteaching.admins'))->notify(new \App\Notifications\VideoCreated($event->video));
    }
}
