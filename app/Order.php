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
    	'user_id', 'event_id', 'contact_id', 'order_status', 'order_amount', 'administration_fee', 'payment_status', 'payment_method', 'payment_amount', 'first_name', 'last_name', 'email', 'phone'
    ];

    /**
     * Set the order's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords(trim(preg_replace('/\s+/', ' ', $value)));
    }

    /**
     * Set the order's last name.
     *
     * @param  string  $value
     * @return void
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords(trim(preg_replace('/\s+/', ' ', $value)));
    }

    /**
     * Set the order's phone.
     *
     * @param  string  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = trim(preg_replace('/\s+/', ' ', $value));
    }

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
}
