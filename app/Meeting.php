<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','notulen_id', 'room_id','meeting_date','time','notes','created_at','updated_at','topic'
    ];
    
    // users/ participants has many participants
    public function participants()
    {
        return $this->belongsToMany('App\User');
    }

    // user relation as notulen of meeting, meeting belongs to user
    public function notulen()
    {
        return $this->belongsTo('App\User','notulen_id');
    }

    public function rooms()
    {
        return $this->belongsTo('App\Room','room_id');
    }

    public function getShortDateAttribute(){
        $meeting_date = new Carbon($this->meeting_date);
        return $meeting_date->format('Y-m-d');
    }

    public function getShortDateIndonesiaAttribute(){
        $meeting_date = new Carbon($this->meeting_date);
        return $meeting_date->translatedFormat('d-M-Y');
    }

    public function getDayAttribute(){
        $meeting_date = new Carbon($this->meeting_date);
        return $meeting_date->translatedFormat('l');
    }

    public function getHourTimeAttribute(){
        $meeting_date = new Carbon($this->meeting_date);
        return $meeting_date->format('H:i');
    }

    // ROLE belong to many USER, TABLE PIVOT : role_user, PIVOT USER: user_id, PIVOT_ROLE: role_ide
    // return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
}