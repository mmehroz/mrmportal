<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMilestone extends Model
{

    protected $fillable = [
        'project_id', 'milestone_id','milestone', 'bidder_id', 'bidder_amount', 'sale_id', 'sale_amount', 'team_id', 'team_amount', 'user_id'
    ];
    protected static $logAttributes = [
        'project_id', 'milestone_id','milestone', 'bidder_id', 'bidder_amount', 'sale_id', 'sale_amount', 'team_id', 'team_amount', 'user_id'
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
