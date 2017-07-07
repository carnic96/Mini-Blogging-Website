<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //
    protected $fillable = [
        'user_id', 'followed_by_id'
    ];

    function users() 
    {
    	return $this->belongsTo('App\User');
    }
}
