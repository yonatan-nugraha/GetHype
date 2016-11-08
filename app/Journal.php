<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'title', 'content', 'status', 'slug', 'tag'
    ];

    /**
     * Get the image for the event.
     */
    public function image()
    {
        $filename = md5('journal-' . $this->id) . '.jpg';
        if (file_exists(public_path() . '/images/journals/'. $filename)) {
            return $filename;
        } else {
            return 'default.jpg';
        }     
    }
}
