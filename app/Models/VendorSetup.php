<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorSetup extends Model
{
    protected $fillable = [
        'company_id',
        'name', //lokasi tersedianya vendor, range harga, 
        'value',
    ];
}
