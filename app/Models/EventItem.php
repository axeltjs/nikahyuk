<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventItem extends Model
{
    public function model()
    {
        return $this->morphTo();
    }
}
