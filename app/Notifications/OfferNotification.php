<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class OfferNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
            'type' => 'penawaran',
            'message' => 'Customer atas nama ' . $this->user->name . ' sedang mencari vendor, segera tawarkan penawaran terbaikmu!',
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'from' => 'customer',
            'next_route' => route('quotation.index'),
            'survey' => url('customer/survey/'.$this->user->survey->id)
        ];
    }
}
