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
    	'title', 'content', 'status', 'slug'
    ];
}
