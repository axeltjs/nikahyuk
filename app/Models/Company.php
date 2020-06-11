<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name', //nama usaha
        'address', //alamat usaha
        'identity_card', //ktp/sim
        'business_permit', //izin usaha
        'photo', //tempat usaha
        'budget_min',
        'budget_max',
        'approved',
        'reject_reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');        
    }

    public function vendorSetup()
    {
        return $this->hasMany(VendorSetup::class, 'company_id');        
    }

    public function eventItem()
    {
        return $this->morphMany(eventItem::class, 'model');        
    }

    public function getApprovedFormatAttribute()
    {
        if($this->getAttribute('approved') == 1){
            return "<span class='label label-success'><i class='fa fa-check'></i> Approved</span>";
        }elseif($this->getAttribute('approved') == 2){
            return "<span class='label label-danger'><i class='fa fa-close'></i> Rejected</span>";
        }else{
            return "<span class='label label-info'> <i class='fa fa-hourglass'></i> On Progress</span>";
        }
    }

    public function getMinMaxBudgetAttribute()
    {
        return "Rp. ".number_format($this->getAttribute('budget_min'))." Sampai dengan Rp. ".number_format($this->getAttribute('budget_max'));
    }

    public function getKtpFormatAttribute()
    {
        $file_name = $this->getAttribute('identity_card');
        if($file_name){
            return "<img src='".url('storage/company/'.$file_name)."' class='img' style='max-width:450px; height:auto;'/>";
        }

        return null;
    }

    public function getIzinUsahaFormatAttribute()
    {
        $file_name = $this->getAttribute('business_permit');
        if($file_name){
            return "<img src='".url('storage/company/'.$file_name)."' class='img' style='max-width:450px; height:auto;'/>";
        }

        return null;
    }

    public function getTempatUsahaFormatAttribute()
    {
        $file_name = $this->getAttribute('photo');
        if($file_name){
            return "<img src='".url('storage/company/'.$file_name)."' class='img' style='max-width:450px; height:auto;'/>";
        }

        return null;
    }

}
