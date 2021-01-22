<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'password','address','phonenumber',
        'created_at','updated_at','group_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function meetings()
    {
        return $this->belongsToMany('App\Meeting');
    }

    // user has many meeting
    public function notulen() {
        
        return $this->hasMany('App\Meeting', 'notulen_id');
    }
    

    // group_id belongsTo Groups
    public function groups()
    {
        return $this->belongsTo('App\Group','group_id','id');
    }

    // group_id belongsTo Groups
    public function job_titles()
    {
        return $this->belongsTo('App\Job_title','job_title_id','id');
    }


    public function getShortNameAttribute(){
        
        $data = explode(" ",$this->name);

        $name = isset($data[1]) ? $data[0].' '.$data[1] : $data[0];
        
        return $name;
    }
    
}