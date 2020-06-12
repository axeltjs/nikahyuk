<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'number',
        'customer_id',
        'vendor_id',
        'amount',
        'status',
        'payment_method'
    ];

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'transaction_id');        
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');        
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');        
    }

    /**
     * 
     * Mutator
     * 
     */

    public function getStatusFormatAttribute()
    {
        if($this->getAttribute('status') === 1){
            return 'Disetujui';
        }elseif($this->getAttribute('status') === 2){
            return 'Ditolak';
        }elseif($this->getAttribute('status') === 3){
            return 'Selesai';
        }else{
            return 'Diproses';
        }
    }

    public function getCreatedAtFormatAttribute()
    {
        return date('d-m-Y H:i', strtotime($this->getAttribute('created_at')));
    }

    public function getPaymentMethodFormatAttribute()
    {
        if($this->getAttribute('payment_method') === 'cash'){
            return "Cash";
        }else{
            return $this->getAttribute('payment_method')."x Cicilan";
        }
    }

    public function getAmountFormatAttribute()
    {
        return "Rp. ".number_format($this->getAttribute('amount'));
    }

    public function getStatusFormatHtmlAttribute()
    {
        if($this->getAttribute('status') === 1){
            return '<span class="label label-success">Disetujui</span>';
        }elseif($this->getAttribute('status') === 2){
            return '<span class="label label-danger">Ditolak</span>';
        }elseif($this->getAttribute('status') === 3){
            return '<span class="label label-primary">Selesai</span>';
        }else{
            return '<span class="label label-info">Diproses</span>';
        }
    }
}
