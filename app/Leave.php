<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Leave extends Model
{
    use LogsActivity;

    protected $fillable = [
        'reason', 'date_to', 'date_from', 'status', 'user_id', 'no_of_days'
    ];

    protected static $logAttributes = [
        'reason', 'date_to', 'date_from', 'status', 'user_id', 'no_of_days'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}