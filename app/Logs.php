<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Logs extends Model
{
    protected $table = 'activity_log';

    public function scopeActive($query){
        $query->whereStatus(1);
    }

    public function getCauserIDAttribute($value){
         return  ucfirst(User::where('id', $value)->pluck('name')->first());
    }

    public function getSubjectTypeAttribute($value){
         return str_replace('App\\', '', $value);
    }
}
