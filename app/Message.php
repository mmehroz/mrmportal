<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model 
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
            
    public static function getUsers()
    {
        $receiver_id = self::where('user_id',auth()->id())
                            ->orWhere('receiver_id',auth()->id())
                            ->pluck('receiver_id')->toArray();
        $user_id = self::where('user_id',auth()->id())
                        ->orWhere('receiver_id',auth()->id())
                        ->pluck('user_id')->toArray();
        return array_merge($receiver_id,$user_id);
    }   

        public static function getUnreadCount()
    {
        $receiver_id = self::where('is_seen' , 0)
                            ->where('receiver_id',auth()->id())
                            ->count();
        return $receiver_id;
    }
}
