<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Auth;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password',
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

    public function scopeFilter($query, $request)
    {
        return $query->where('name', 'LIKE', '%'.$request->get('q').'%')
            ->orWhere('email', 'LIKE', '%'.$request->get('q').'%');
    }

    public function scopeExceptMe($query)
    {
        return $query->where('id', '!=', Auth::user()->id);
    }
}
