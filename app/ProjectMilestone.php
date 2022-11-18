<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMilestone extends Model
{

    protected $fillable = [
        'amount', 'project_id', 'date',  'user_id'
    ];
    protected static $logAttributes = [
        'amount', 'project_id', 'date',  'user_id'
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
