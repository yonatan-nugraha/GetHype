<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCollection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'collection_id', 'event_id'
    ];

    /**
     * Get the collection that owns the event collection.
     */
    public function event_collection()
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * Get the event that owns the event collection.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
