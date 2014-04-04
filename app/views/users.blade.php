@extends('layout')

@section('content')
    Users!
 @foreach($users as $user)
        <p>{{ $user->email }}</p>
    @endforeach
@stop

