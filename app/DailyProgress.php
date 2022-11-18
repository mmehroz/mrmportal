<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyProgress extends Model
{
     // protected $table = "daily_target";
      protected $guarded = [];

      public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }  
     public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    } 
}
