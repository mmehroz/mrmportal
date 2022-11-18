<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Permission extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'display_name', 'group'
    ];

    protected static $logAttributes = [
        'name', 'display_name', 'group'
    ];

    public function scopeActive($query){
        $query->whereStatus(1);
    }

    // Create relation on service providers table
    public function Roles() {
        return $this->hasMany( Role::class);
    }
}
