<!--フォローしているユーザー一覧-->
@extends('layouts.app')

@section('content')
    @if (Auth::check())
    <div class="row">
        <aside class="col-sm-4">
            @include('users.card', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            @include('users.navtabs', ['user' => $user])
            @include('users.users', ['users' => $users])
        </div>
    </div>
    @endif
@endsection