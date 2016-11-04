<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'ticket_group_id', 'order_id', 'code', 'status', 'booked_by'
    ];

    /**
     * Get the ticket group that owns the ticket.
     */
    public function ticket_group()
    {
        return $this->belongsTo(TicketGroup::class);
    }

    /**
     * Get the order that owns the ticket.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
