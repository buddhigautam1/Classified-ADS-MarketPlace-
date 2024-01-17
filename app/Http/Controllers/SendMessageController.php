<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SendMessageController extends Controller
{
    
    /* public function __construct()
    {
        $this->middleware(['auth','verified']);
    } */
    public function store(Request $request)
    {
        Message::create([
            'user_id' => $request->userId,
            'receiver_id' => $request->receiverId,
            'ad_id' => $request->adId,
            'body' => $request->body,
        ]);
    }

    public function index()
    {
        return view('message.index');
    }

    public function chatWithThisUser()
    {
        $conversations = Message::orderBy('id','DESC')->
            where('user_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->get();
            
        $users  = $conversations->map(function ($conversation) {
            if ($conversation->user_id === auth()->id()) {
                return $conversation->receiver;
            }
            return $conversation->sender;
        })->unique();
        return $users;
    }
    public function showMessages(Request $request, $id)
    {
        $messages = Message::with(['user','ads'])->where('receiver_id', auth()->user()->id)
            ->where('user_id', $id)
            ->orWhere('user_id', auth()->user()->id)
            ->where('receiver_id', $id)
            ->get();
        return $messages;
    }
    public function startConversation(Request $request)
    {
        $message = Message::create([
            'user_id'=> Auth::user()->id,
            'receiver_id'=>$request->receiverId,
            'body'=>$request->body
        ]);
        return $message->load('user');
    }
}
