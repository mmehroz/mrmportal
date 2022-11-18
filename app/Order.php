<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use LogsActivity;

    protected $fillable = [
        'order_id', 'order_time', 'order_date', 'order_status', 'payment_status', 'amount', 'currency', 'description', 'brand_id', 'send_invoice', 'customer_email', 'sale_person','flag', 'first_name', 'last_name', 'address', 'city', 'country', 'state', 'zip_code', 'phone_number', 'bank_name', 'card_type', 'card_number', 'card_name', 'expiration_month', 'expiration_year', 'card_cvv', 'transection_type','terms','notes'
    ];

    protected static $logAttributes = [
        'order_id', 'order_time', 'order_date', 'order_status', 'amount', 'currency', 'description', 'brand_id', 'send_invoice', 'customer_email', 'sale_person','flag', 'first_name', 'last_name', 'address', 'city', 'country', 'state', 'zip_code', 'phone_number', 'bank_name', 'card_type', 'card_number', 'card_name', 'expiration_month', 'expiration_year', 'card_cvv', 'transection_type'
    ];

    public function scopeActive($query){
        $query->whereOrderStatus(1);
    }

    public function orderLineItem()
    {
        return $this->hasMany(OrderLineItem::class);
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    } 

     public function user()
    {
        return $this->hasOne(User::class, 'id', 'sale_person');
    }
}
