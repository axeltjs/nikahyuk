<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'company_id',
        'approved',
         //nullable,
    ];

    public function scopeFilter($query, $request)
    {
        return $query->where('title', 'LIKE', '%'.$request->get('q').'%')
            ->orWhere('description', 'LIKE', '%'.$request->get('q').'%');
    }

}
