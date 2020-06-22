<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Auth;
use App\Notifications\ChatNotification;
use App\Notifications\OfferCompleteNotification;
use App\Notifications\OfferNotification;
use App\Notifications\PaymentConfirmNotification;
use App\Notifications\CreateTransactionNotication;
use App\Notifications\PromotionVendorNotif;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected static function boot() {
        parent::boot();
        
        static::deleting(function($check) {
            $check->survey()->delete();
            $check->company()->delete();
            $check->selectedVendor()->delete();
            $check->selectedClient()->delete();
            $check->quotationVendor()->delete();
            $check->quotationClient()->delete();
            $check->notification()->delete();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'password', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function survey()
    {
        return $this->hasOne(Survey::class, 'user_id');        
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'user_id');        
    }

    public function selectedVendor()
    {
        return $this->hasMany(SelectedVendor::class, 'vendor_id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'customer_id');
    }

    public function transactionVendor()
    {
        return $this->hasMany(Transaction::class, 'vendor_id');
    }

    public function selectedClient()
    {
        return $this->hasMany(SelectedVendor::class, 'customer_id');
    }

    public function quotationVendor()
    {
        return $this->hasMany(Quotation::class, 'creator_id');
    }

    public function quotationClient()
    {
        return $this->hasMany(Quotation::class, 'customer_id');
    }

    public function notification()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function unreadNotificationChat()
    {
        return $this->notifications()
                    ->whereNull('read_at')
                    ->where('type', ChatNotification::class)
                    ->latest()
                    ->limit(10);
    }

    public function unreadTransactionNotification()
    {
        return $this->notifications()
                    ->whereNull('read_at')
                    ->where('type', PaymentConfirmNotification::class)
                    ->orWhere('type', CreateTransactionNotication::class)
                    ->orWhere('type', PromotionVendorNotif::class)
                    ->latest()
                    ->limit(10);
    }

    public function unreadNotificationOffer() 
    {
        return $this->notifications()
                    ->whereNull('read_at')
                    ->whereIn('type', [OfferCompleteNotification::class, OfferNotification::class]);
    }

    public function scopeFilter($query, $request)
    {
        return $query->where('name', 'LIKE', '%'.$request->get('q').'%')
            ->orWhere('email', 'LIKE', '%'.$request->get('q').'%');
    }

    public function scopeExceptMe($query)
    {
        return $query->where('id', '!=', Auth::user()->id);
    }

    public function getPhotoFormatUrlAttribute()
    {
        $url = asset('admin/images/user.png');
        
        if($this->getAttribute('photo') !== null){
            $url = url('storage/user/'.$this->getAttribute('photo'));
        }

        return $url;
    }
}
