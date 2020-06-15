<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'company_id',
        'score',
        'review',
        'customer_id'
    ];
}
