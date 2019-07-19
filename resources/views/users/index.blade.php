@extends('layouts.app')

@section('content')
    @if (Auth::check())
    @include('users.users', ['users' => $users])
    @endif
@endsection