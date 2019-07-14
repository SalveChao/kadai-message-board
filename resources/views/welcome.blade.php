@extends('layouts.app')

@section('content')


    @if (Auth::check())
        <h3>タスク一覧</h3>
        <table class="table table-bordered table-striped">
            <tr>
              <th>id</th>
              <th>ステータス</th>
              <th>メッセージ</th>
            </tr>
           @foreach($microposts as $micropost)
            <tr>
              <td>{!! link_to_route('microposts.show', $micropost->id, ['id' => $micropost->id]) !!}</td>
              <td></td>
              <td>{{ $micropost->content }}</td>
            </tr>
           @endforeach
        </table>
        <p></p>{{ $microposts->render('pagination::bootstrap-4') }}</p>
        <div>
        {!! link_to_route('microposts.create', '新規投稿', [], ['class' => "btn btn-lg btn-primary"]) !!}
        </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => "btn btn-lg btn-primary"]) !!}
            </div>
        </div>
    @endif
@endsection