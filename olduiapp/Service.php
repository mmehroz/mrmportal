<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Service extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'status', 'user_id', 'sorting_order'
    ];

    protected static $logAttributes = [
        'name', 'status', 'user_id', 'sorting_order'
    ];

    public function scopeActive($query){
        $query->whereStatus(1);
    }
}
