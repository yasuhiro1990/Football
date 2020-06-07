@extends('layouts.header')
@section('title', '検索')

@section('content')
    <div class="container">
        <div class="row">
            <h2>検索</h2>
        </div>
        <div class="row">
           <div class="col-12 border bg-info">
                <form action="{{ action('Admin\AcountController@search') }}" method="get">
                    <div class="form-group row col-10 mx-auto py-3">
                        <label>試合希望日</label>
                        <div class="col-8">
                            <input type="date" class="form-control" name="cond_day" value="{{ $cond_day }}">
                            <p class="h5 py-1">~</p>
                            <input type="date" class="form-control" name="cond_day2" value="{{ $cond_day2 }}">
                        </div>
                        <div class="form-group row col-10">
                            
                            <label for="city">地域</label>
                                <div class="col-12">
                                    <select name="cond_city">
                                        @foreach($prets as $index => $name)
                                            <option value="{{$name}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="col-10 from-group row">
                            <label for="hope_game">希望試合</label>
                            <div class="col-12">
                                <select name="cond_hope_game">
                                    @foreach($hopes as $ex => $hope)
                                       <option value="{{$hope}}">{{$hope}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 pt-3">
                            <input type="search" name="free" placeholder="フリーワード"> 
                        </div>
                        <div class="col-md-12 pt-3">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索" class="searches">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-12 mx-auto pt-5">
                @if($posts !=null)
               
                <div class="posts row">
                   
                        @foreach($posts as $acount)
                   
                        <div class="row border border-white col-10 mt-3 mx-auto">
                            
                            <div class="col-12 d-flex flex-row">
                                <a href="{{action('Admin\AcountController@yourpage',['id'=>$acount->id]  )}}"><img src="{{asset('storage/image/' . $acount->image_path)}}" width="150" height="150"></a>
                                <div class="col-9 mx-auto">
                                    <a href="{{action('Admin\AcountController@yourpage',['id'=>$acount->id]  )}}" class="h2 text-center">{{$acount->team}}</a>
                                    <div class="col-md-12 h6 pt-2">
                                        <p>{{\Str::limit($acount->introduce,50)}}</p>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        
                        @endforeach
                     
                </div>
                   
                    
                @endif
                <div class="paginate pt-3 mx-auto col-6 d-flex justify-content-center">
                        {{$posts->appends(request()->input())->links()}}
                </div> 
            </div>
        </div>
    </div>
@endsection
