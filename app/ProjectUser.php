<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    
    protected $fillable = [
        'member_id', 'project_id', 'user_id'
    ];

    public function user() {
        return $this->hasMany(User::class, 'id', 'member_id');
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
