<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Quotation;

class OfferCompleteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Vendor ' . $this->quotation->vendor->company->name . ' telah memberikan penawaran ke kamu. cek sekarang juga!',
            'user_id' => $this->quotation->vendor->id,
            'user_name' => $this->quotation->vendor->name,
            'quotation_id' => $this->quotation->id,
            'quotation_package_name' => $this->quotation->package_name,
            'from' => 'vendor',
            'next_route' => route('customer.chat.index')
        ];
    }
}
