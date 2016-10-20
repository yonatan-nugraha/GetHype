<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'subject', 'description', 'first_name', 'last_name', 'email', 'phone', 'status'
    ];
}
