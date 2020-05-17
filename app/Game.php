<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //
    protected $connection ='mysql3';
    protected $table='games';
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
