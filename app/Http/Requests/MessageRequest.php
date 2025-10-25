<?php

namespace App\Http\Requests;

class MessageRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'message' => 'required',
            'file' => 'nullable',
            'receiver_id'=>'required'
        ];
    }

}
