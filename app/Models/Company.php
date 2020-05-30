<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name', //nama usaha
        'address', //alamat usaha
        'identity_card', //ktp/sim
        'business_permit', //izin usaha
        'photo', //tempat usaha
        'budget_min',
        'budget_max'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');        
    }

    public function vendorSetup()
    {
        return $this->hasMany(VendorSetup::class, 'company_id');        
    }

    public function eventItem()
    {
        return $this->morphMany(eventItem::class, 'model');        
    }

}
