@extends('layouts.header')


@section('title', 'マイページ')

@section('content')
    <div class="container">
        <div class="row">
                <div class="col-12 flex-row">
                @foreach($posts as $acount)
                    @if($acount->image_path)    
                        <div class="text-center">
                            <img src="{{ $acount->image_path}}" width="200" height="200">
                        </div>
                    @endif
                </div>
            
                <div class="col-12 pt-5">
                    <div class="col-4 pb-3 float-right text-right mr-5">
                        <a href="{{action('Admin\AcountController@edit')}}" type="button" class="btn btn-info text-center px-3">編集</a>
                    </div>
                    <table border="1" class="col-10 justify-content-center mx-auto mybox"  style="table-layout:fixed;width:100%;">
                        <tr>
                            <td width="40%" class="py-3 text-center">代表者名</td>
                            <td width="60%" class="pl-3">{{$acount->representative}}</td>
                        </tr>
                        <tr>
                            <td width="40%" class="py-3 text-center">チーム名</td>
                            <td width="60%" class="pl-3">{{$acount->team}}</td>
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
                @endforeach
                <!--お気に入り-->
                <div class="pt-5 col-12">
                    <label class="h3">お気に入りチーム</label>
                    @if($fav!=null)
                    <div class="col-12 border">
                        @foreach($fav as $favs)
                            <a href="{{action('Admin\AcountController@yourpage',['id'=>$favs->fav_id]  )}}">{{$favs->team}}<br></a>
                        @endforeach
                    </div>
                    @endif
                </div>
                <!--試合応募済み-->
                <div class="pt-5 col-12">
                    <label class="h3">試合応募済みチーム</label>
                    @if($game!=null)
                    <div class="col-12 border">
                        @foreach($game as $games)
                            <a href="{{action('Admin\AcountController@yourpage',['id'=>$games->game_id]  )}}">{{$games->team}}<br></a>
                        @endforeach
                    </div>
                    @endif
                </div>
        </div>
    </div>
@endsection