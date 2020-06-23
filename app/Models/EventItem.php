<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventItem extends Model
{
    protected $table = 'event_item';

    public function model()
    {
        return $this->morphTo();
    }

    public function scopeFilter($query, $request, $date, $date_end)
    {
        if($request->get('q') != null){
            $query = $query->where('name', 'LIKE', '%'.$request->get('q').'%');
        }

        if($date != null && $date_end != null){
            $query = $query->whereBetween('created_at', [$date, $date_end]);
        }

        return $query;
    }
}
