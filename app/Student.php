<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table ="students";
    
    protected $primaryKey = 'nim';
    
    protected $keyType = 'string';

    protected $hidden = [
        'password',
    ];

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nim','name','password','email','created_at','updated_at'
    ];

    // rooms has many meeting
    public function krs_consultations()
    {
        return $this->hasOne('App\KRSConsultation','student_id');
    }
}