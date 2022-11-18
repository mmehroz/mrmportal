<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Attendance extends Model
{
    protected $guarded = [];

    protected static $logAttributes = [
        'user_id',
        'attendance_user_id',
        'date',
        'routine_check_in',
        'routine_checkout',
        'today_check_in',
        'today_check_out',
        'difference_time',
        'is_late',
        'update_by',
        'description',
        'status',
        'pending'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
