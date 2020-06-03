<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat;

class ChatController extends Controller
{
    public function __construct(Chat $chat) {
        $this->chat = $chat;
    }

    public function index() {
        $user_id = auth()->user()->id;

        $chatItems = $this->chat->with('vendor')->where('customer_id', $user_id)->get();

        $view = [
            'chatItems' => $chatItems
        ];

        return view('admin.chat.index', $view);
    }
}
