@extends('layouts/main')

@section ('title', 'Home page')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
    <h1>Login form</h1>
    <form action="{{route('login.auth')}}" method="post">
    @csrf
    <div class="form-group">
    <label for="email">Email address</label>
    <input name = "email"  type="email" class="form-control " id="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
  </div>

  <div class="form-check">
    <input name='remember' class="form-check-input" type="checkbox" id="remember">
    <label class="form-check-label" for="remember">
      Remember me
    </label>
  <button type="submit" class="btn btn-primary">LogIn</button>
  <a href="{{route('password.request')}}">Forgot request</a>
</form>
</div>
  </div>
@endsection