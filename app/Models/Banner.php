<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'image',
        'name',
        'placeholder',
        'type',
        'promotion_id' //nullable,
    ];

    public function scopeFilter($query, $request)
    {
        if($request->has('q') || $request->get('q') != null){
            $query = $query->where('name', 'LIKE', '%'.$request->get('q').'%')
            ->orWhere('placeholder', 'LIKE', '%'.$request->get('q').'%');
        }

        return $query;
    }

    public function getImageFormatAttribute()
    {
        $url = url('storage/banner/'.$this->getAttribute('image'));

        return "<a target='__blank' href='".$url."'><img class='banner-img' src='".$url."' style='max-width:150px; height:auto;'></a>";
    }

    public function getImageUrlAttribute()
    {
        return url('storage/banner/'.$this->getAttribute('image'));
    }
}
