<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use \App\Http\Controllers\Traits\TraitDate;

    protected $appends = ['event_date_range'];
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

    public function getEventDateRangeAttribute()
    {
        return $this->convertToRange($this->getAttribute('event_date'), $this->getAttribute('event_date_end'));
    }
}
