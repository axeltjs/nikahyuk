<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat;

class ChatVendorController extends Controller
{
    public function __construct(Chat $chat) {
        $this->chat = $chat;
    }

    public function index() {
        $user_id = auth()->user()->id;

        $chatItems = $this->chat->with('customer')->where('vendor_id', $user_id)->get();

        $view = [
            'chatItems' => $chatItems
        ];

        return view('admin.chat.index', $view);
    }
}
