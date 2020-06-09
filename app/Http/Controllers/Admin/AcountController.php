<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Acount;
use App\Admin;
use App\User;
use App\Favorite;
use App\Game;
use Auth;
use Carbon\Carbon;
use Log;
use App\People;
use Storage;


class AcountController extends Controller
{   
    // ホーム画面表示
    public function home()
    {
    
        return view('first');

    }
    //アカウント登録画面表示
    public function add()
    {
        $prets=config('pref');
        $hopes=config('hope');
        $peoples=config('people');
        return view('admin.acount',['prets'=>$prets,'hopes'=>$hopes,'peoples'=>$peoples]);
    }
    // アカウント登録
    public function create(Request $request)
    {
        $this->validate($request,Acount::$rules);
        
        $form=$request->all();
        //パスワード判定
        if($form['password']!=$form['password_confirm']){
             abort(403, 'パスワードが一致しません');
        }
        unset($form['password_confirm']);
        // メールアドレス判定
        if(User::where('email',$form['email'])->exists()){
          abort(403, '既にメールアドレスが登録しています');
        }
        $acount=new Acount;
        $user=new User;
        $people=new People;
        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $acount->image_path = Storage::disk('s3')->url($path);
      } else {
         $acount->image_path=url('https://footballs.s3.us-east-2.amazonaws.com/hKiQouistDh92TgGIShgQ2FJWjpLwYUziEHmRgSw.png');
      }

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      
      
      // データベースに保存する
      $acount->fill($form);
      $acount->password=Hash::make($acount->password);
      $user->name=$acount->representative;
      $user->email=$acount->email;
      $user->password=$acount->password;
      
      $people->fill($form);
      
      $acount->save();
      $user->save();
      $people->save();
      

      return redirect('first');
    }
    // マイページ表示
    public function index(){
       
        $users=Auth::user();
        $posts=Acount::where('id',$users->id)->get();
        $fav=Favorite::where('user_id',$users->id)->get();
        $game=Game::where('user_id',$users->id)->get();
        $peoples=People::find($users->id);
        return view('admin.mypage',['posts'=>$posts,'fav'=>$fav,'game'=>$game,'peoples'=>$peoples]);
    }
    
    
    // 検索画面結果
    public function search(Request $request)
    {
        $prets=config('pref');
        $hopes=config('hope');
        
        $cond_day=$request->cond_day;
        $cond_day2=$request->cond_day2;
        $cond_city=$request->cond_city;
        $cond_hope_game=$request->cond_hope_game;
        $posts=null;
        $cond_posts=Acount::query();
        $free=$request->free;
        // if($cond_day =='' && $cond_day2 == '' && $cond_hope_game=='選択してください' && $cond_city =='選択してください' && $free ==''){
            
        // }else{
            
        
            if($cond_day !=''){
                if($cond_day2 !=''){
                    $cond_posts->whereDate('day','>',$cond_day)->whereDate('day','<',$cond_day2);
                    
                    }else{
                        $cond_posts->whereDate('day','>',$cond_day);
                    }
            
                }elseif($cond_day2 !=''){
                    $cond_posts->whereDate('day','<',$cond_day2);
                }
              
            if($cond_city !='選択してください'){
                $cond_posts->where('city',$cond_city);
            }
            
            if($cond_hope_game !='選択してください'){
                $cond_posts->where('hope_game',$cond_hope_game);
            }
          
            if($free !=''){
                $cond_posts->where('introduce','LIKE',"%{$free}%")
                   ->orWhere('team','LIKE',"%{$free}%");
            }
            $user=Auth::user();
            if($user!=null){
                $cond_posts->where('id','!=',$user->id);
            }
            
            
            $posts=$cond_posts->paginate(5);
            
            Log::debug($posts);
        // }
        return view('search',['posts'=>$posts,'cond_day'=>$cond_day,'cond_day2'=>$cond_day2,'prets'=>$prets,'hopes'=>$hopes]);
    }
    
    
    //編集
    public function edit()
    {
        $users=Auth::user();
        $acount_form=Acount::where('id',$users->id)->first();
        $people_form=People::where('id',$users->id)->first();
        $prets=config('pref');
        $hopes=config('hope');
        $peoples=config('people');
        return view('admin.edit',['acount_form'=>$acount_form,'prets'=>$prets,'hopes'=>$hopes,'peoples'=>$peoples,'people_form'=>$people_form]);
    }
    
    
    
    //更新
    public function update(Request $request)
    {
        $this->validate($request,Acount::$rules);
        
        $acount = Acount::find($request->id);
        $user=User::find($request->id);
        $people=People::find($request->id);
        $acount_form = $request->all();
        //パスワード判定
        if($acount_form['password']!=$acount_form['password_confirm']){
             abort(403, 'パスワードが一致しません');
        }
        unset($acount_form['password_confirm']);
        
        if(isset($acount_form['image'])){
            $path=$request->Storage::disk('s3')->putFile('/',$acount_form['image'],'public');
            $acount->image_path=Storage::disk('s3')->url($path);
            unset($acount_form['image']);
        }elseif(isset($request->remove)){
            unset($form['remove']);
            $acount->image_path=basename('zGueDwQFbK0QSCFrQ0UCeKMoMxoX9HXbVsG0DXuK.png');
           
        }
            unset($acount_form['_token']);
            
            
            $acount->fill($acount_form);
            $acount->password=Hash::make($acount->password);
            $acount->save();
            $people->fill($acount_form)->save();
            $user->name=$acount->representative;
            $user->email=$acount->email;
            $user->password=$acount->password;
            $user->save();
        return redirect('admin/mypage');   
    }
    
    // 検索結果のページ
    public function yourpage(Request $request){
        
        $posts=Acount::where('id',$request->id)->get();
        $peoples=People::find($request->id);
        
        $user=Auth::user();
        if($user==null){
            $fav=null;
            $game=null;
        }else{
    
        $fav=Favorite::where('user_id',$user->id)
                        ->where('fav_id',$request->id)
                       ->first();
        $game=Game::where('user_id',$user->id)
                        ->where('game_id',$request->id)
                       ->first();
        }
        
        $title=$posts->first();
        Log::debug($title);
        return view('yourpage',['posts'=>$posts,'fav'=>$fav,'game'=>$game,'peoples'=>$peoples])->with('title',$title->team."のページ");
    }
}
