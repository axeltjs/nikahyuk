<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'amount',
        'status',
        'jatuh_tempo',
        'transaction_id'
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'transaction_id');        
    }

    public function getAmountFormatAttribute()
    {
        return "Rp. ".number_format($this->getAttribute('amount'));
    }

    public function getUpdatedAtFormatAttribute()
    {
        return date('d-m-Y H:i', strtotime($this->getAttribute('updated_at')));
    }
}
