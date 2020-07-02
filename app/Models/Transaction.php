<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'number',
        'customer_id',
        'vendor_id',
        'amount',
        'status', // proses transaksi
        'payment_method',
        'quotation_id'
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');        
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'transaction_id');        
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');        
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');        
    }

    public function scopeHasProcessedTransaction($query)
    {
        // diproses atau disetujui
        return $query->where('status', 0)->orWhere('status', 1);
    }

    /**
     * @param Request $request
     * @param array $date
     * @return Collection $query
     */
    public function scopeFilter($query, $request, $date = null)
    {
        if(isset($date)){
            $query = $query->whereBetween('created_at', [$date['date'], $date['date_end']]);
        }

        if($request->get('status') != "null"){
            $query = $query->where('status', $request->get('status'));
        }

        if($request->get('payment_method') != "null"){
            $query = $query->where('payment_method', $request->get('payment_method'));
        }

        if($request->get('nama') != null){
            $query = $query->whereHas('customer', function($query) use ($request){
                return $query->where('name', 'LIKE', '%'.$request->get('nama').'%');
            });
        }

        if($request->get('vendor') != null){
            $query = $query->with(['vendor' => function($query) use ($request){
                return $query->whereHas('company', function($query) use ($request){
                    return $query->where('name', 'LIKE', '%'.$request->get('nama').'%');
                });
            }]);
        }

        if($request->get('nomor') != null){
            $query = $query->where('number', 'LIKE', '%'.$request->get('nomor').'%');
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
        if($this->getAttribute('status') === 1){
            return 'Disetujui';
        }elseif($this->getAttribute('status') === 2){
            return 'Ditolak';
        }elseif($this->getAttribute('status') === 3){
            return 'Selesai';
        }else{
            return 'Diproses';
        }
    }

    public function getCreatedAtFormatAttribute()
    {
        return date('d-m-Y H:i', strtotime($this->getAttribute('created_at')));
    }

    public function getPaymentMethodFormatAttribute()
    {
        if($this->getAttribute('payment_method') === 'cash'){
            return "Cash";
        }else{
            return "Kredit ".$this->getAttribute('payment_method')."x Cicilan";
        }
    }

    public function getAmountFormatAttribute()
    {
        return "Rp. ".number_format($this->getAttribute('amount'));
    }

    public function getStatusFormatHtmlAttribute()
    {
        if($this->getAttribute('status') === 1){
            return '<span class="label label-success">Disetujui</span>';
        }elseif($this->getAttribute('status') === 2){
            return '<span class="label label-danger">Ditolak</span>';
        }elseif($this->getAttribute('status') === 3){
            return '<span class="label label-primary">Selesai</span>';
        }else{
            return '<span class="label label-info">Diproses</span>';
        }
    }
}
