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
    	'ticket_group_id', 'code', 'status'
    ];

    /**
     * Get the ticket group that owns the ticket.
     */
    public function ticket_group()
    {
        return $this->belongsTo(TicketGroup::class);
    }
}
