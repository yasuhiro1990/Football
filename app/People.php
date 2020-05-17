<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    //
    protected $connection ='mysql4';
    protected $table='peoples';
    protected $guarded=array('id');
    
    
    protected $fillable=['professional','normal','beginner','none'
    ];
  
        
    
    public function acounts(){
         return $this->hasMany('App\Acount');
    }
}
