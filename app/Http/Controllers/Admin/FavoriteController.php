<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Request as PostRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Acount;
use App\Admin;
use App\User;
use App\Game;
use App\Favorite;
use Auth;
use Carbon\Carbon;
use Log;
use Storage;
// 作成したメールクラスをuseする
use App\Mail\ContactMail;
use App\Mail\AuthContactMail;
use Illuminate\Support\Facades\Mail;


class FavoriteController extends Controller
{
    // ボタン判定
    public function postHoge(Request $request){
        $name=PostRequest::input('name');
        Log::debug($request);
        Log::debug(PostRequest::get('name'));
        if(PostRequest::get('fav')){
            $this->favorite($request->id);
        }elseif(PostRequest::get('game')){
            $this->game($request->id);
        }
        return redirect()->action('Admin\AcountController@yourpage',['id'=>$request->id]);
    }
    //
    // お気に入り登録
    public function favorite($id){
        
        $acount=Acount::find($id);
        $user=Auth::user();
        $fav=new Favorite;
        $fav->fav_id=$acount->id;
        $fav->user_id=$user->id;
        $user_boolean=Favorite::where('user_id',$user->id)
                                ->where('fav_id',$acount->id)
                                ->exists();
        
        // tureなら削除
         if($user_boolean==true){
            $fav=Favorite::where('fav_id',$id)->delete();
        // その他は登録
         }else{
            
            $fav->representative=$acount->representative;
            $fav->team=$acount->team;
            $fav->city=$acount->city;
            $fav->hope_game=$acount->hope_game;
            $fav->introduce=$acount->introduce;
            $fav->image_path=$acount->image_path;
            $fav->day=$acount->day;
            $fav->save();
        }
        
        
    }
    //試合登録
    public function game($id){
        
        $acount=Acount::find($id);
        $user=Auth::user();
        $auth=Acount::find($user->id);
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
        Mail::to($acount->email)
            ->send(new ContactMail($auth));
        
        $game->save();
       
    }
    
}
