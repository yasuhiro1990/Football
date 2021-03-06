@extends('layouts.header')
@section('title', '編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>編集</h2>
                <form action="{{ action('Admin\AcountController@update') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="representative">代表者名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="representative" value="{{ $acount_form->representative }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="team">チーム名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="team" value="{{ $acount_form->team }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="email">メールアドレス</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" name="email" value="{{ $acount_form->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="password">パスワード</label>
                        <div class="col-md-10">
                            <input type="password" name="password" class="form-control" maxlength="16">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="password_confirm">パスワード確認</label>
                        <div class="col-md-10">
                            <input type="password" name="password_confirm" class="form-control"  minlength="8" maxlength="16">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="telephone">電話番号</label>
                        <div class="col-md-10">
                            <input type="tel" pattern="[0-9]{3}[0-9]{4}[0-9]{4}" class="form-control" name="telephone" value="{{ $acount_form->telephone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="city">地域</label>
                        <div class="col-md-10">
                            <select name="city">
                                @foreach($prets as $index => $name)
                                    <option value="{{$name}}" @if( "{{ $acount_form->city }}"== "{{$name}}" ) selected @endif> {{$name}} </option>
                                @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="hope_game">希望相手</label>
                        <div class="col-md-10">
                            <select name="hope_game">
                                @foreach($hopes as $ex => $hope)
                                   <option value="{{$hope}}" @if("{{$acount_form->hope_game}}"=="{{$hope}}" ) selected @endif> {{$hope}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="hope_game">チーム構成</label>
                        <div class="col-md-10 d-flex flex-row">
                            <p> 上級者 ✖️</p>
                            <select name="professional">
                               @foreach($peoples as $ex => $man)
                                   <option value="{{$man}}" @if("{{$people_form->professional}}"=="{{$man}}" ) selected @endif>{{$man}}</option>
                               @endforeach
                            </select>
                            <p>人</p>
                        </div>
                        <div class="col-md-10 d-flex flex-row" >
                            <p> 中級者 ✖️</p>
                            <select name="normal">
                               @foreach($peoples as $ex => $man)
                                   <option value="{{$man}}" @if("{{$people_form->normal}}"=="{{$man}}" ) selected @endif>{{$man}}</option>
                               @endforeach
                            </select>
                            <p>人</p>
                        </div>
                        <div class="col-md-10 d-flex flex-row">
                            <p> 初心者 ✖️</p>
                            <select name="beginner">
                               @foreach($peoples as $ex => $man)
                                   <option value="{{$man}}" @if("{{$people_form->beginner}}"=="{{$man}}" ) selected @endif>{{$man}}</option>
                               @endforeach
                            </select>
                            <p>人</p>
                        </div>
                        <div class="col-md-10 d-flex flex-row">
                            <p> 未経験 ✖️</p>
                            <select name="none">
                               @foreach($peoples as $ex => $man)
                                   <option value="{{$man}}" @if("{{$people_form->none}}"=="{{$man}}" ) selected @endif>{{$man}}</option>
                               @endforeach
                            </select>
                            <p>人</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="introduce">チーム紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduce" row="10">{{$acount_form->introduce}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                               {{ $acount_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name=remove value="true">画像削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="day">希望日</label>
                        <div class="col-md-10">
                            <input name="day" type="date" max="9999-12-31" value="{{$acount_form->day}}">
                        </div>
                    </div>
                    <div form-group row>
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{$acount_form->id}}">
                      
                            {{ csrf_field() }}
                             <input type="submit" class="btn btn-primary" value="更新">
                
                          </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection