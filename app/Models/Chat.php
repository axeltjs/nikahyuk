<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';

    protected $fillable = [
        'vendor_id',
        'customer_id',
    ];

    public function vendor() {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function chatMessage() {
        return $this->hasMany(ChatMessage::class, 'chat_id');
    }
}
