<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id', 'event_id', 'amount', 'order_status', 'payment_status', 'payment_type'
    ];

    /**
     * Get the order details for the order.
     */
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Get the event that owns the order.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
