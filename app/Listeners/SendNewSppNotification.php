<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewSppNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewSppNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::whereHas('roles', function ($query) {
                $query->where('id', 2);
            })->get();

        Notification::send($admins, new NewSppNotification($event->user));
    }
}
