<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation_note extends Model
{
    protected $table ="consultation_notes";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'krs_consultation_id','comment','status','created_at','updated_at'
    ];

    // rooms has many meeting
    public function krs_consultations()
    {
        return $this->belongsTo('App\KRSConsultation','krs_consultation_id');
    }
}