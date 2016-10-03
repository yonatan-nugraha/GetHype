<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class TicketGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'event_id', 'name', 'price', 'status', 'started_at', 'ended_at'
    ];

    /**
     * Get the event that owns the ticket group.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the total tickets for the ticket group.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get the available tickets for the ticket group.
     */
    public function tickets_available()
    {
        return $this->hasMany(Ticket::class)
        ->where('status', 1);
    }
}
