<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Quotation extends Model
{
    use Notifiable;
    
    protected $fillable = [
        'package_name',
        'description',
        'file',
        'price',
        'customer_id', 
        'creator_id' //vendor
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'customer_id');        
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'creator_id');        
    }

    public function getPriceFormatAttribute()
    {
        return "Rp. ".number_format($this->getAttribute('price'));
    }

    public function scopeFilter($query, $request)
    {
        if($request->has('q')){
            return $query->whereHas('client', function($query) use ($request){
                return $query->where('name', 'LIKE', '%'.$request->get('q').'%');            
            })->orWhere('package_name', 'LIKE', '%'.$request->get('q').'%')
            ->orWhere('price', 'LIKE', '%'.$request->get('q').'%');
        }
    }
}
