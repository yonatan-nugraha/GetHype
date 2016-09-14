<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'category_id', 'event_type_id', 'name', 'description', 'location', 'started_at', 'ended_at', 'status', 'slug'
    ];

    /**
     * Get the category that owns the event.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the event_type that owns the event.
     */
    public function event_type()
    {
        return $this->belongsTo(EventType::class);
    }

    /**
     * Get the ticket groups for the event.
     */
    public function ticket_groups()
    {
        return $this->hasMany(TicketGroup::class);
    }
}
