<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=['message','sender_id','receiver_id'];


    public function receiver(){
        $this->belongsTo(User::class,'receiver_id');
    }
    public function sender(){
        $this->belongsTo(User::class,'sender_id');
    }
}
