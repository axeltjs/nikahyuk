<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OfferCompleteNotification;

class SendOfferCompleteNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = User::where('id', $event->user_id)->first();

        Notification::send($user, new OfferCompleteNotification($event->quotation));
    }
}
