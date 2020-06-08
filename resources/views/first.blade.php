@extends('layouts.header')


@section('title', 'マッチングフットサル')

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-12">
                <div class="col-12">
                    <img src="https://footballs.s3.us-east-2.amazonaws.com/futsal.png" alt="マッチングフットサル" width="100%" height="300">
                </div>
                <div class="pt-5 col-12 menu">
                    <div class="d-md-flex justify-content-center">
                        <div class="nav-item d-flex justify-content-center text-center">
                            @guest
                                <li><a href="{{action('Admin\AcountController@create')}}"><span>新規登録</span><br><img src="https://footballs.s3.us-east-2.amazonaws.com/new.jpeg" width="260" height="260"></a></li>
                            @else
                                <li><a href="{{action('Admin\AcountController@index')}}"><span>マイページ</span><br><img src="https://footballs.s3.us-east-2.amazonaws.com/doubble.jpeg" width="260" height="260"></a></li>
                            @endguest
                        </div> 
                        <div class="nav-item d-flex justify-content-center text-center">
                            <li><a href="{{action('Admin\AcountController@search')}}"><span>チーム検索</span><br><img src="https://footballs.s3.us-east-2.amazonaws.com/search.jpeg" width="260" height="260"></a></li>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
