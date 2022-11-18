<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Lab404\Impersonate\Models\Impersonate;

class User extends Authenticatable
{
    use Notifiable, LogsActivity, Impersonate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type', 'is_customer', 'status', 'phone', 'cnic', 'birth_date', 'joining_date', 'emergency_name', 'emergency_phone', 'target_individual', 'perc_individual', 'target_team', 'perc_team', 'daily_pitch', 'no_of_leaves', 'address', 'picture','check_in', 'check_out','attendance_id','isallow'
    ];

    protected static $logAttributes = [
        'name', 'email', 'password', 'user_type', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() {
        return $this->belongsTo(Role::class, 'user_type', 'id');
    }

    public function getPermissionsAttribute()
    {
        return RolePermission::where('role_id', auth()->user()->user_type)->pluck('permission_id')->toArray();
    }

      public function order()
    {
        return $this->belongsTo(Order::class);
    }

        public function target()
    {
        return $this->belongsTo(DailyTarget::class);
    }
       public function progress()
    {
        return $this->belongsTo(DailyProgress::class);
    }

      public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

       public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function projectUsers()
    {
        return $this->belongsTo(ProjectUsers::class);
    }
       public function customer()
    {
        return $this->belongsTo(User::class);
    }
    public function sale()
    {
        return $this->belongsTo(User::class);
    }
     public function bidder()
    {
        return $this->belongsTo(User::class);
    }

       public function team()
    {
        return $this->belongsTo(Team::class);
    }

     public function teamMembers()
    {
        return $this->belongsTo(TeamMembers::class);
    }

      public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

}
