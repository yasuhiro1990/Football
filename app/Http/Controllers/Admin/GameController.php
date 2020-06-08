<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Acount;
use App\Admin;
use App\User;
use App\Favorite;
use Auth;
use App\Game;
use Carbon\Carbon;
use Log;
use Storage;

class GameController extends Controller
{
    //試合登録
    public function game(Request $request){
        
        $acount=Acount::find($request->id);
        $user=Auth::user();
        $game=new Game;
        $game->game_id=$acount->id;
        $game->user_id=$user->id;
        
        $game->representative=$acount->representative;
        $game->team=$acount->team;
        $game->city=$acount->city;
        $game->hope_game=$acount->hope_game;
        $game->introduce=$acount->introduce;
        $game->image_path=$acount->image_path;
        $game->day=$acount->day;
        $game->save();
        
        
        return redirect()->action('Admin\AcountController@yourpage',['id'=>$request->id]);
        
    }
}
