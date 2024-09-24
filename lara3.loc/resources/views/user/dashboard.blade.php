@extends('layouts.main')

@section('title','Dashboard')

@section('content')
    <h1>Dashboard</h1>
    <h3>Your, email {{auth()->user()->name}}</h3>
    <h3>Your, email {{auth()->user()->email}}</h3>
    <h3>Your, password {{auth()->user()->password}}</h3>
    <a class="w-50 bg-primary text-light text-decoration-none p-2 my-2 rounded"" href="{{route('logout')}}">Exit</a>
@endsection