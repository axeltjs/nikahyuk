<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\User;

class DeleteSendOfferCompleteNotification
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
        $notification = DatabaseNotification::whereJsonContains('data->quotation_id', $event->quotation_id)
                            ->first();
        if ($notification !== null) {
            $notification->delete();
        }
    }
}
