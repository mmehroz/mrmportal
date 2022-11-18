<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class OrderLineItem extends Model
{
    use LogsActivity;

    protected $fillable = [
        'order_id', 'service_name'
    ];

    protected static $logAttributes = [
        'order_id', 'service_name'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
