<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMembers extends Model
{
   	protected $guarded = [];

 	public function user() {
        return $this->hasMany(User::class, 'id', 'member_id');
    }
    
    public function team_lead() {
        return $this->hasOne(User::class, 'id', 'member_id');
    }


    public function team() {
        return $this->belongsTo(Team::class);
    }

}
