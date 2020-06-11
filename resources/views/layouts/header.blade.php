<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
         <!--{{-- 後の章で説明します --}}-->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--{{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}-->
        <title>@yield('title')</title>

        <!-- Scripts -->
         <!--{{-- Laravel標準で用意されているJavascriptを読み込みます --}}-->
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="{{ secure_asset('js/yourpage.js') }}"></script>  
        
  
     
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <!--{{-- Laravel標準で用意されているCSSを読み込みます --}}-->
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        
        <!--{{-- この章の後半で作成するCSSを読み込みます --}}-->
        <link href="{{ secure_asset('css/header.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/yourpage.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/first.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/footer.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/search.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/mypage.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <!--<div class="clearfix"></div>-->
            <!--{{-- 画面上部に表示するナビゲーションバーです。 --}}-->
            <nav class="navbar navbar-expand-md navbar-laravel">
                <div class="container nav-laravel">
                   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Togglenavigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse nav-contents" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto col-md-12 humbuger">
                            <li><a href="{{action('Admin\AcountController@home')}}" >ホーム</a></li>
                            <li><a href="{{action('Admin\AcountController@search')}}">チーム検索</a></li>
                            <!--新規登録-->
                            @guest
                                <li><a href="{{action('Admin\AcountController@create')}}">新規登録</a></li>
                            <!--マイページ表示-->
                            @else
                                <li><a href="{{action('Admin\AcountController@index')}}">マイページ</a></li>
                            @endguest
                            @guest
                                <li><a href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                            <!--{{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}-->
                            @else
                                <li class="nav-item">
                                    <div>
                                        <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                {{ __('messages.Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <!--{{-- ここまでナビゲーションバー --}}-->

            <main class="py-4">
                <!--{{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}-->
                @yield('content')
            </main>
            <footer style="width:100%;">
            <div class="d-flex justify-content-center align-items-center container" style="height:50px;">
                    <ul class="navbar-nav footer-link">
                        <li class="nav-item"><a href="{{action('Admin\AcountController@home')}}" >ホーム</a></li>
                        <li class="nav-item center"><a href="{{action('Admin\AcountController@search')}}">チーム検索</a></li>
                        <li class="nav-item"><a href="#app">▲</a></li>
                    </ul>
                <div class="clearfix"></div>
            </div>
            </footer> 
        </div>
      
    </body>
</html>
