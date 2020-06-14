<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    protected $fillable = [
        'number',
        'amount',
        'status',
        'jatuh_tempo',
        'transaction_id',
        'bukti_bayar'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');        
    }

    public function getAmountFormatAttribute()
    {
        return "Rp. ".number_format($this->getAttribute('amount'));
    }

    public function scopeFilter($query, $request)
    {
        if($request->has('q') || $request->get('q') != null){
            $query = $query->whereHas('transaction', function($query) use ($request){
                return $query->whereHas('customer', function($query) use ($request){
                    return $query->where('name', 'LIKE', '%'.$request->get('q').'%');
                });
            });
        }

        return $query;
    }

    /**
     * 
     * Mutator
     * 
     */

    public function getStatusFormatAttribute()
    {
        if($this->getAttribute('status') == 1){
            return "<span class='label label-success'>Terbayar</span>";
        }elseif($this->getAttribute('status') == 2){
            return "<span class='label label-primary'>Dalam Proses Verifikasi</span>";
        }else{
            return "<span class='label label-danger'>Belum Dibayar</span>";
        }
    }

    public function getStatusFormatTextAttribute()
    {
        if($this->getAttribute('status') == 1){
            return "<span style='color:green'>Terbayar</span>";
        }elseif($this->getAttribute('status') == 2){
            return "<span class='label label-primary'>Dalam Proses Verifikasi</span>";
        }else{
            return "<span style='color:red'>Belum Dibayar</span>";
        }
    }

    public function getDeadlineCountHtmlAttribute()
    {
        $carbon = Carbon::now()->diffInDays($this->getAttribute('jatuh_tempo'),false);

        if($this->getAttribute('status')){
            return "&nbsp;";   
        }else{
            if(Carbon::now()->gt($this->getAttribute('jatuh_tempo'))){
                return "<br><small style='color:red;'>Anda telah melewati jatuh tempo!</small>";
            }else{
                return "<br><small>(Kurang <b><i>".$carbon." hari</i></b> lagi sampai jatuh tempo)</small>";
            }
        }
    }

    public function getJatuhTempoFormatAttribute()
    {
        return date('d F Y', strtotime($this->getAttribute('jatuh_tempo')));
    }
}
