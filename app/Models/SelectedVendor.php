<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelectedVendor extends Model
{
    protected $fillable = [
        'customer_id',
        'vendor_id',
    ];

    public function client()
    {
        return $this->belonsTo(User::class, 'customer_id');        
    }

    public function vendor()
    {
        return $this->belonsTo(User::class, 'vendor_id');        
    }
}
