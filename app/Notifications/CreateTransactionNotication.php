<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Transaction;

class CreateTransactionNotication extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
            'message' => 'Transaksi Anda telah dibuat! dengan nomor transaksi: '.$this->transaction->number,
            'vendor_id' => $this->from_user,
            'customer_id' => $this->to_user,
            'user_name' => $this->transaction->vendor->company->name,
            'transaction_id' => $this->transaction->id,
            'transaction_number' => $this->transaction->number,
            // 'from' => 'vendor',
            'next_route' => url('transaction/'.$this->transaction->id)
        ];
    }
}
