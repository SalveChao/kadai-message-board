@extends('layouts.app')

@section('content')

    @if (Auth::check())
        <div class="row">
        <div class="col-6">
            {!! Form::model($micropost, ['route' => 'microposts.store']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'タイトル:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'メッセージ:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>
            {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        </div>
    @endif

@endsection