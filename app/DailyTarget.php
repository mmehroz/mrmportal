<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyTarget extends Model
{
     protected $table = "daily_target";
     protected $fillable = [
        'bid_link', 'bid_date', 'is_chat', 'is_sale', 'amount', 'user_id','is_request','is_approved','requested_data', 'profile_link', 'customer_name','sale_person_id'
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function profile()
    {
        return $this->belongsTo( Profile::class, 'profile_link');
    }
}
