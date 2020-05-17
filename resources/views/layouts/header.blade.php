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

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <!--{{-- Laravel標準で用意されているCSSを読み込みます --}}-->
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        
        <!--{{-- この章の後半で作成するCSSを読み込みます --}}-->
        <link href="{{ secure_asset('css/header.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/yourpage.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/footer.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <div class="navbar">
                <div class="nav-item">
                    <h1>フットボール</h1>
                </div>
                <div class="nav-item">
                    <h3>通知</h3>
                </div>
                <!--新規登録-->
                @guest
                <div class="nav-item">
                    <li><a class="btn btn-primary" href="{{action('Admin\AcountController@create')}}">新規登録</a></li>
                </div>
                <!--マイページ表示-->
                @else
                <div class="nav-item">
                    <li><a class="btn btn-primary" href="{{action('Admin\AcountController@index')}}">マイページ</a></li>
                </div>
                @endguest
                <div class="nav-item">
                @guest
                    <li class><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                        <!--{{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}-->
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} 
                            <span class="caret"></span>
                        </a>
                    
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
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
                              
                </div>
            </div>
            <!--<div class="clearfix"></div>-->
            <!--{{-- 画面上部に表示するナビゲーションバーです。 --}}-->
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="container">
                   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse collapsed" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li><a href="{{action('Admin\AcountController@home')}}" class="btn-square-shadow">ホーム</a></li>
                            <li><a href="{{action('Admin\AcountController@search')}}"class="btn-square-shadow">検索</a></li>
                            <li><a href="{{action('Admin\AcountController@index')}}"class="btn-square-shadow">マイページ</a></li>
                        </ul>

                    
                    </div>
                </div>
            </nav>
            <!--{{-- ここまでナビゲーションバー --}}-->

            <main class="py-4">
                <!--{{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}-->
                @yield('content')
            </main>
        </div>
       <footer>
            <div>
                <h4>Copyright</h4>
            </div>
        </footer>
    </body>
</html>
