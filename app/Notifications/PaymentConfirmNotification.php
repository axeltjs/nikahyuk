<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Invoice;

class PaymentConfirmNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($role, $to_user, $from_user, Invoice $invoice)
    {
        $this->role = $role;
        $this->to_user = $to_user;
        $this->from_user = $from_user;
        $this->invoice = $invoice;
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
            $message = 'Pembayaran '.$this->invoice->number.' telah <b>'.$this->invoice->status_format_notif.'</b> oleh Admin';
            $url = url('invoice/'.$this->invoice->transaction->id);
        }else{
            $message = 'Ada pembayaran yang harus dikonfirmasi. Pembayaran no. '.$this->invoice->number;
            $url = url('admin/payment/validation?id='.$this->invoice->id);
        }

        return [
            'type' => 'payment_confirm',
            'message' => $message,
            'vendor_id' => $this->from_user,
            'customer_id' => $this->to_user,
            'user_name' => $this->invoice->transaction->customer->name,
            'invoice_id' => $this->invoice->id,
            'invoice_number' => $this->invoice->number,
            'next_route' => $url
        ];
    }
}
