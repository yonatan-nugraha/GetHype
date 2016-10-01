<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'order_id', 'ticket_group_id', 'quantity'
    ];

    /**
     * Get the order that owns the order details.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the ticket group that is owned by the order detail.
     */
    public function ticket_group()
    {
        return $this->belongsTo(TicketGroup::class);
    }
}
