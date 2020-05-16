<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'package_name',
        'description',
        'file',
        'price',
        'customer_id', 
        'creator_id' //vendor
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'customer_id');        
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'creator_id');        
    }

    public function getPriceFormatAttribute()
    {
        return "Rp. ".number_format($this->getAttribute('price'));
    }

}
