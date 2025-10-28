<?php

namespace App\Http\Controllers\Webcontrollers\Chat;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    Public function users(){
        $users=User::all();
        $user=Auth::user();
        return view('user.home.users',compact(
            'users','user'
        ));
    }

    Public function userChat(User $user){
        $receiverId=$user->id;
        $messages= Message::where(function ($query) use ($user) {
            $query->where('sender_id', Auth::id())
                 ->where('receiver_id', $user->id);
                })->orWhere(function ($query) use ($user) {
                   $query->where('sender_id', $user->id)
                    ->where('receiver_id', Auth::id());
              })->get();
        return view('user.chat.privetchat',compact(
            'messages','user'
        ));
    }
}
