<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ChatNotification;
use App\Models\User;

class SendChatNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $to_user, User $from_user)
    {
        $this->to_user = $to_user;
        $this->from_user = $from_user;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Notification::send($event->to_user, new ChatNotification($event->to_user, $event->from_user));
    }
}
