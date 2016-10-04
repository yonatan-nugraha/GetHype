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
    	'user_id', 'event_id', 'contact_id', 'order_status', 'order_amount', 'administration_fee', 'payment_status', 'payment_type', 'payment_amount'
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

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the contact that owns the order.
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
