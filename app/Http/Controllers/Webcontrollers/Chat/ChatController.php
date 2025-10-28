<?php

namespace App\Http\Controllers\webcontrollers\Chat;

use App\Events\SendMessage;
use App\Events\UserTyping;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ChatController extends Controller
{
    public function sendMessage( Request $request, User $user){
        try {
            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $user->id,
                'message' => $request->message,
            ]);

            broadcast(new SendMessage($message))->toOthers();
            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function typing(){
        broadcast(new UserTyping(Auth::id()))->toOthers();
        return response()->json(['status'=>'typing']);

    }
    public function setOnline(){
        Cache::put('user-is-online' . Auth::id(),true,now()->addMinutes(5));
        return response()->json(['status'=>'online']);

    }
    public function setOffline(){
        Cache::put('user-is-offline' . Auth::id(),true);
        return response()->json(['status'=>'offline']);

    }



}
