<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'description', 'slug', 'status', 'weight'
    ];

    /**
     * Get the image for the event.
     */
    public function image()
    {
        $filename = md5('collection-' . $this->id) . '.jpg';
        if (file_exists(public_path() . '/images/collections/'. $filename)) {
            return $filename;
        } else {
            return 'default.jpg';
        }     
    }

    /**
     * Get the events for the collection.
     */
    public function event_collections()
    {
        return $this->hasMany(EventCollection::class);
    }
}
