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

    /**
     * Set the message's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords(trim(preg_replace('/\s+/', ' ', $value)));
    }

    /**
     * Set the message's last name.
     *
     * @param  string  $value
     * @return void
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords(trim(preg_replace('/\s+/', ' ', $value)));
    }

    /**
     * Set the message's phone.
     *
     * @param  string  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = trim(preg_replace('/\s+/', ' ', $value));
    }

    /**
     * Set the message's subject.
     *
     * @param  string  $value
     * @return void
     */
    public function setSubjectAttribute($value)
    {
        $this->attributes['subject'] = trim(preg_replace('/\s+/', ' ', $value));
    }

    /**
     * Set the message's description.
     *
     * @param  string  $value
     * @return void
     */
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = trim($value);
    }
}
