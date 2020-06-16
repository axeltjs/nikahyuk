<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PromotionVendorNotif extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($role, $to_user, $from_user, $promo_id)
    {
        $this->role = $role; 
        $this->to_user = $to_user; 
        $this->from_user = $from_user; 
        $this->promo_id = $promo_id;
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
        if($this->role == 'admin'){ //dari admin
            $message = 'Artikel Promosi Anda telah disetujui admin. klik untuk melihat';
            $url = url('vendor/promotion/'.$this->promo_id);
        }else{
            $message = 'Ada Artikel Promosi yang memerluka persetujuan Anda. klik untuk melihat';
            $url = url('admin/promotion?id='.$this->promo_id);
        }

        return [
            'type' => 'promotion',
            'message' => $message,
            'user_name' => 'Notifikasi Promosi',
            'vendor_id' => $this->from_user,
            'customer_id' => $this->to_user,
            'promotion_id' => $this->promo_id,
            'next_route' => $url
        ];
    }
}
