<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_message';

    protected $fillable = [
        'chat_id',
        'user_id',
        'message'
    ];

    public function chat() {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
