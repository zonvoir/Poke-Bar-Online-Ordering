<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestAssistant extends Model
{
    protected $fillable = ['chat_id','message','restorant_id','reciever','response_msg'];
    public function restorant()
    {
        return $this->belongsTo('App\Restorant');
    }
}
