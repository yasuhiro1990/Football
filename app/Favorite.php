<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //
    protected $connection ='mysql2';
    protected $table='favorites';
    protected $guarded=array('id');
    
    protected $fillable=['representative','team','city','hope_game'
    ,'introduce','day','image','user_id'
    ];
    
    
    
    
    public function users(){
        return $this->hasMany('App\User');
    }
    public function acounts(){
        return $this->hasMany('App\Acount');
    }
}
