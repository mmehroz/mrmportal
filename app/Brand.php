<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Brand extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name', 'picture', 'status', 'user_id', 'sorting_order','detail'
    ];

    protected static $logAttributes = [
        'name', 'picture', 'status', 'user_id', 'sorting_order'
    ];

    public function scopeActive($query){
        $query->whereStatus(1);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'brand_id', 'id');
    }
}
