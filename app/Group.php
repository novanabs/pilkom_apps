<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $primaryKey = 'id';

    protected $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','created_by','created_at','updated_at'
    ];

    // groups has many users
    public function users()
    {
        return $this->hasMany('App\User','group_id','id');
    }

    // group has many permissions
    public function permissions()
    {
        return $this->hasMany('App\Permission');
    }
}