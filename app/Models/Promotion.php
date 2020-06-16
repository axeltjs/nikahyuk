<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');        
    }

    public function scopeFilter($query, $request)
    {
        if($request->has('q') || $request->get('q') != null){
            $query = $query->where('title', 'LIKE', '%'.$request->get('q').'%')
            ->orWhere('description', 'LIKE', '%'.$request->get('q').'%');
        }

        if($request->has('id') || $request->get('id') != null){
            $query = $query->where('id', $request->get('id'));
        }

        return $query;
    }

    public function getDescriptionFormatAttribute()
    {
        return Str::limit(strip_tags($this->getAttribute('description')),120);
    }

    public function getImageFormatAttribute()
    {
        $url = url('storage/promotion/'.$this->getAttribute('image'));

        return "<a target='__blank' href='".$url."'><img class='banner-img' src='".$url."' style='max-width:150px; height:auto;'></a>";
    }

    public function getStatusFormatAttribute()
    {
        if($this->getAttribute('approved') == 0){
            return "<label class='label label-info'>Proses Verifikasi</label>";
        }elseif($this->getAttribute('approved') == 1){
            return "<label class='label label-success'>Disetujui</label>";
        }else{
            return "<label class='label label-danger'>Ditolak</label>";
        }
    }

}
