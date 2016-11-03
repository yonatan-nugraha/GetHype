<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'description', 'slug', 'status'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the events for the event type.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
