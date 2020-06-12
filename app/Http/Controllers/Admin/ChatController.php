<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use Exception;
use DB;
use App\Events\SendChatNotification;

class ChatController extends Controller
{
    public function __construct(Chat $chat) {
        $this->chat = $chat;
    }

    public function index() {
        $user_id = auth()->user()->id;

        $chatItems = $this->chat->with('vendor')->where('customer_id', $user_id)->get();

        $view = [
            'chatItems' => $chatItems,
            'user_id' => $user_id
        ];

        return view('admin.chat.index', $view);
    }

    public function sendMessage(Request $request) {
        DB::beginTransaction();

        try {
            $chat = $this->chat->find($request->id);
            if ($chat !== null) {

                $chatMessage = $chat->chatMessage()->save(
                    new ChatMessage([
                        'user_id' => auth()->user()->id,
                        'message' => $request->message
                    ])
                );

                $data_view = view('admin.chat.send_message')->with([
                    'item' => $chatMessage
                ])->render();

                $message = 'Chat Berhasil Dikirim';
                $user_id = $chat->vendor_id;
                $chat_id = $chat->id;

                $data_receive_view = view('admin.chat.receive_message')->with([
                    'item' => $chatMessage
                ])->render();

                $status = true;

                DB::commit();

                event(new SendChatNotification($chat->vendor, $chat->customer));
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return [
            'data' => [
                'status' => $status ?? false,
                'message' => $message ?? '',
                'user_id' => $user_id ?? null,
                'chat_id' => $chat_id ?? null
            ],
            'data_view' => $data_view ?? null,
            'data_receive_view' => $data_receive_view ?? null
        ];
    }

    public function getAllMessage(Request $request) {
        $data = collect();
        $transaction = 0;

        try {
            $chat = $this->chat->find($request->id);

            if ($chat !== null) {
                $data = $chat->chatMessage;

                $transaction = $this->transaction->where(['vendor_id' => $chat->vendor_id, 'customer_id' => $chat->customer_id])
                    ->where('status', 1)
                    ->orWhere('status', 0)
                    ->count();
            }
        } catch (Exception $e) {

        }

        return [
            'data' => $data,
            'transaksi' => $transaction,
            'data_view' => view('admin.chat.all_message')->with([
                'data' => $data,
                'user_id' => auth()->user()->id
            ])->render()
        ];
    }

    public function getUnreadNotification()
    {
        try {
            $notifications = auth()->user()->unreadNotificationChat;

            return [
                'status' => true,
                'data_view_count' => $notifications->count(),
                'data_view_message' => view('admin.chat.all_chat_notif')->with([
                    'notifications' => $notifications
                ])->render()
            ];
        } catch (Exception $e) {
            return [
                'status' => false
            ];
        }
    }
}
