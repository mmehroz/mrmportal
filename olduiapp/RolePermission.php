<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RolePermission extends Model
{
//    use LogsActivity;

    protected $table = 'role_permissions';

    protected $fillable = [
        'role_id', 'permission_id', 'user_id'
    ];

    protected static $logAttributes = [
        'role_id', 'permission_id', 'user_id'
    ];

    // Create relation on service providers table
    public function permission() {
        return $this->hasMany(Permission::class);
    }

    // Create relation on service providers table
    public function user() {
        return $this->hasMany(User::class, 'id', 'user_type');
    }
}
