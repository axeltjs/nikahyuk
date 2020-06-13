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
        'transaction_id'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');        
    }

    public function getAmountFormatAttribute()
    {
        return "Rp. ".number_format($this->getAttribute('amount'));
    }

    public function getStatusFormatAttribute()
    {
        if($this->getAttribute('status')){
            return "<span class='label label-success'>Terbayar</span>";
        }else{
            return "<span class='label label-danger'>Belum Terbayar</span>";

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
