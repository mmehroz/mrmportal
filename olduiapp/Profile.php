<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'name', 'status', 'user_id'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function project()
    {
        return $this->hasMany(Project::class, 'id');
    }

    public function target()
    {
        return $this->hasOne(DailyTarget::class);
    }
}
