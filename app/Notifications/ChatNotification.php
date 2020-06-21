<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class ChatNotification extends Notification
{
    use Queueable;

   
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $to_user, User $from_user)
    {
        $this->to_user = $to_user;
        $this->from_user = $from_user;
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
            'type' => 'chat',
            'message' => 'Pesan Baru Belum Dibaca Dari ' . $this->from_user->name, 
            'from_user_id' => $this->from_user->id,
            'from_user_name' => $this->from_user->name,
            'photo_profile' => $this->from_user->photo_format_url,
            'to_user_id' => $this->to_user->id,
            'to_user_name' => $this->to_user->name,
        ];
    }
}
