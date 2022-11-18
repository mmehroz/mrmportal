<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name', 'team_target', 'user_id'
    ];

    protected static $logAttributes = [
        'name', 'team_target', 'user_id'
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

     public function teamMembers()
    {
        return $this->hasMany(TeamMembers::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
