<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'user_id',
        'budget',
        'event_date',
        'location_lat',
        'location_long',
        'theme'
    ];

    public function user()
    {
        return $this->belonsTo(User::class, 'user_id');        
    }
}
