<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\SendOfferNotification as SendOfferNotificationListener;
use App\Listeners\SendOfferCompleteNotification as SendOfferCompleteNotificationListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\SendOfferNotification as SendOfferNotificationEvent;
use App\Events\SendOfferCompleteNotification as SendOfferCompleteNotificationEvent;
use App\Events\DeleteSendOfferCompleteNotification as DeleteSendOfferCompleteNotificationEvent;
use App\Listeners\DeleteSendOfferCompleteNotification as DeleteSendOfferCompleteNotificationListener;
use App\Events\SendChatNotification as SendChatNotificationEvent;
use App\Listeners\SendChatNotification as SendChatNotificationListener;

use App\Events\SendChatNotification as SendCreateTransactionNotificationEvent;
use App\Listeners\SendChatNotification as SendCreateTransactionNotificationListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SendOfferNotificationEvent::class => [
            SendOfferNotificationListener::class
        ],
        SendOfferCompleteNotificationEvent::class => [
            SendOfferCompleteNotificationListener::class
        ],
        DeleteSendOfferCompleteNotificationEvent::class => [
            DeleteSendOfferCompleteNotificationListener::class
        ],
        SendChatNotificationEvent::class => [
            SendChatNotificationListener::class
        ],
        SendCreateTransactionNotificationEvent::class => [
            SendCreateTransactionNotificationListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
