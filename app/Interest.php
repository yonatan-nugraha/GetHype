<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id', 'category_id'
    ];

    /**
     * Get the category that owns the interest.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
