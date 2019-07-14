@extends('layouts.app')

@section('content')
    <h1>id = {{ $micropost->id }} のメッセージ詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $micropost->id }}</td>
        </tr>
        <tr>
            <th>メッセージ</th>
            <td>{{ $micropost->content }}</td>
        </tr>
    </table>
{!! link_to_route('microposts.edit', 'メッセージ編集', ['id' => $micropost->id], ['class' => 'btn btn-lg btn-warning']) !!}
@endsection