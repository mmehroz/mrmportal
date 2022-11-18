<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

         public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
      public function customer()
    {
        return $this->hasOne(User::class,'id','customer_id');
    }
      public function sale()
    {
        return $this->hasOne(User::class,'id','sale_id');
    }

    public function bidder()
    {
        return $this->hasOne(User::class,'id','bidder_id');
    }
    public function projectUser()
    {
        return $this->hasMany(ProjectUser::class);
    }
    public function team()
    {
        return $this->hasOne(Team::class,'id','team_id');
    }

     public function comments()
    {
        return $this->hasMany(ProjectComments::class)->orderBy('id', 'desc');
    }
}