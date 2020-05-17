<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acount extends Model
{
    //
    protected $guarded=array('id');
    
    
    protected $fillable=['representative','team','email','password','telephone','city','hope_game'
    ,'introduce','day','image',
    ];
    protected $hidden=['password'];
    
    public static $rules=array(
        'representative'=>'required',
        'team'=>'required',
        'telephone'=>'required',
        'email'=>'required',
        'password'=>'required',
        'city'=>'required',
        'hope_game'=>'required',
        'introduce'=>'required',
        'day'=>'required',
        );
        
    public function users(){
        return $this->hasMany('App\User');
    }
    
}
