<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KRSConsultation extends Model
{
    protected $table ="krs_consultations";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','student_id','user_id','slip_ukt','khs','transkrip','krs_sementara','created_at','updated_at'
    ];


    // rooms has many meeting
    public function users()
    {
        return $this->belongsTo('App\User','id');
    }

    public function students()
    {
        return $this->belongsTo('App\Student','student_id');
    }

    public function consultation_notes()
    {
        return $this->hasOne('App\Consultation_note','krs_consultation_id');
    }
}