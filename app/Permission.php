<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','sub_menu_key', 'sub_menu_value','sub_menu_view','group_id','created_at','updated_at'
    ];

    public function groups()
    {
        return $this->belongsTo('App\Group','group_id');
    }
}