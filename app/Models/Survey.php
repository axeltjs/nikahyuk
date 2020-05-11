<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'user_id',
        'budget',
        'event_date',
        'event_date_end',
        'location_lat',
        'location_long',
        'city_id',
        'province_id',
        'invitation_qty',
        'theme'
    ];

    public function user()
    {
        return $this->belonsTo(User::class, 'user_id');        
    }
}
