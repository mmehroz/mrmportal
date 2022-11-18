<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'user_id', 'status'
    ];

    protected static $logAttributes = [
        'name', 'user_id', 'status'
    ];

    public function scopeActive($query){
        $query->whereStatus(1);
    }

    // Create relation on service providers table
    public function permission() {
        return $this->hasMany(Permission::class);
    }

    // Create relation on service providers table
    public function user() {
        return $this->hasMany(User::class, 'id', 'user_type');
    }
}
