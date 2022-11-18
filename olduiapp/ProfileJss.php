<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileJss extends Model
{
    protected $table = "profiles_jss";

    protected $fillable = [
        'jss_record', 'profile_id', 'user_id'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function profile()
    {
        return $this->hasMany( Profile::class, 'id');
    }
}
