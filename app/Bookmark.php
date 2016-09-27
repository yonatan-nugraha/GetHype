<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id', 'event_id'
    ];

    /**
     * Get the bookmark event.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
