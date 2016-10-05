<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

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
     * Get the image for the event.
     */
    public function image()
    {
        $filename = md5('event-' . $this->id) . '.jpg';
        if (file_exists(public_path() . '/images/events/'. $filename)) {
            return $filename;
        } else {
            return 'default.jpg';
        }     
    }

    /**
     * Get the banner for the event.
     */
    public function banner()
    {
        $filename = md5('event-banner-' . $this->id) . '.jpg';
        if (file_exists(public_path() . '/images/events/'. $filename)) {
            return $filename;
        } else {
            return 'banner-default.jpg';
        }     
    }

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

    /**
     * Get the available ticket groups for the ticket group.
     */
    public function ticket_groups_available()
    {
        return $this->hasMany(TicketGroup::class)
            ->where('status', 1)
            ->where('started_at', '<=', Carbon::now())
            ->where('ended_at', '>=', Carbon::now());
    }
}
