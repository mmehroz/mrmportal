<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesLead extends Model
{
     protected $table = "sales_lead";
     protected $fillable = [
        'daily_target_id', 'sale_person_id', 'assignee_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
