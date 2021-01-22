<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_title extends Model
{
    protected $primaryKey = 'id';
    
    protected $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','created_at','updated_at'
    ];

    // rooms has many meeting
    public function users()
    {
        return $this->hasMany('App\User','job_title');
    }
}