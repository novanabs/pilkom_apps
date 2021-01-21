<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'description','created_at','updated_at'
    ];

    // rooms has many meeting
    public function meetings()
    {
        return $this->hasMany('App\Meeting','room_id');
    }


}