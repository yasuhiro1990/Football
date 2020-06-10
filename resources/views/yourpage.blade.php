@extends('layouts.header')


<title>{{$title}}</title>

@section('content')
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-12 flex-row">
                @foreach($posts as $acount)
                    @if($acount->image_path)    
                        <div class="text-center">
                            <img src="{{$acount->image_path}}" width="200" height="200">
                        </div>
                    @endif
                </div>
                <div class="col-12 pt-5 yourbox">
                    <table border="1" class="col-10 justify-content-center mx-auto">
                        <tr>
                            <td width="150" class="py-3 text-center">チーム名</td>
                            <td width="250" class="pl-3">{{$acount->team}}</td>
                        </tr>
                        <tr>
                            <td class="text-center py-3 ">地域</td>
                            <td class="pl-3">{{$acount->city}}</td>
                        </tr>
                        <tr>
                            <td class="text-center py-3 ">希望相手</td>
                            <td class="pl-3">{{$acount->hope_game}}</td>
                        </tr>
                        <tr>
                            <td class="text-center py-3 ">チーム構成</td>
                            <td class="pl-3">上級者✖{{$peoples->professional}}人<br>
                                             中級者✖{{$peoples->normal}}人<br>
                                             初心者✖{{$peoples->beginner}}人<br>
                                             未経験者✖{{$peoples->none}}人
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center py-5">チーム紹介</td>
                            <td class="pl-3 py-auto">{{$acount->introduce}}</td>
                        </tr>
                        <tr>
                            <td class="text-center py-3">試合希望日</td>
                            <td class="pl-3">{{$acount->day}}</td>
                        </tr>
                    </table>
                </div>
                <div class="d-md-flex flex-row col-8 text-center pt-5 mx-auto">
                        <!--お気に入り登録-->
                        <div class="row col-md-4 mx-auto d-flex justify-content-center btn-block">
                            @if($fav == null)
                            <form action="{{action('Admin\FavoriteController@postHoge',['id'=>$acount->id])}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <button class="btn-gradient-3d-orange" type="submit" name="fav" value="fav" id="hope">お気に入り</button>
                            </form>
                            @else
                            <form action="{{action('Admin\FavoriteController@postHoge',['id'=>$acount->id])}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <button class="btn-gradient-3d-orange" width=100% type="submit" name="fav" value="fav">お気に入り解除</button>
                            </form>
                            @endif
                        </div>
                        
                        <!--試合したい登録-->
                         <div class="row col-md-4 mx-auto d-flex justify-content-center btn-block mt-0" id="game">
                            @if($game == null)
                            <form name="game_submit" action="{{action('Admin\FavoriteController@postHoge',['id'=>$acount->id])}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <button class="btn-gradient-3d-simple" type="submit" name="game" value="game">試合がしたい</button>
                            </form>
                            @else
                                <button class="btn-gradient-3d-simple" disabled type="button" data-loading-text="申込済み" autocomplete="off">申込済み</button>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
