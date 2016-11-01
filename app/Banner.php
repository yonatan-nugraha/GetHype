<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'type', 'started_at', 'ended_at', 'link_url', 'status'
    ];

    /**
     * Get the image for the banner.
     */
    public function image()
    {
        $filename = md5('banner-' . $this->id) . '.jpg';
        if (file_exists(public_path() . '/images/banners/'. $filename)) {
            return $filename;
        } else {
            if ($this->type == 2) {
                return 'small-banner-default.jpg';
            } else {
                return 'carousel-banner-default.jpg';
            }
        }     
    }
}
