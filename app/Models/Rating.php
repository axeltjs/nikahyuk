<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use \App\Http\Controllers\Traits\TraitStars;
 
    protected $fillable = [
        'company_id',
        'score',
        'review',
        'customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getNilaiAttribute()
    {
        $score = $this->getAttribute('score');
        $html = $this->getScoreHtml($score);

        return $html;
    }
}
