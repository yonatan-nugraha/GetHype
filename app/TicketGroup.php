<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'event_id', 'name', 'price', 'started_at', 'ended_at'
    ];

    /**
     * Get the event that owns the ticket group.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the tickets for the ticket group.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class)->where('status', 1);
    }
}
