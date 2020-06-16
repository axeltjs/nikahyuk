<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PromotionVendorNotif;
use App\Models\User;

class PromotionVendorNotifListener
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
        $user = User::where('id', $event->to_user)->first();
        
        Notification::send($user, new PromotionVendorNotif($event->role, $event->to_user, $event->from_user, $event->promo_id));
    }
}
