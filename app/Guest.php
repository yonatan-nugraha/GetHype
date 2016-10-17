<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'event_id', 'name', 'title', 'description', 'status',
    ];

    /**
     * Get the image for the event.
     */
    public function image()
    {
        $filename = md5('guest-' . $this->id) . '.jpg';
        if (file_exists(public_path() . '/images/guests/'. $filename)) {
            return $filename;
        } else {
            return 'default.jpg';
        }     
    }
}
