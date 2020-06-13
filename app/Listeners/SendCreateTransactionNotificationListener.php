<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\CreateTransactionNotication;
use App\Models\Transaction;

class SendCreateTransactionNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($role, $to_user, $from_user, Transaction $transaction)
    {
        $this->role = $role;
        $this->transaction = $transaction;
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
        Notification::send($event->to_user, new CreateTransactionNotication($event->role, $event->to_user, $event->from_user, $event->transaction));
    }
}
