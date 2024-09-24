@extends('layouts/main')

@section ('title', 'Reset password')

@section('content')
<!-- <h1>Register form</h1> -->
 <!-- 21 name должно повторять поле в таблице БД-->
  <div class="row">
    <div class="col-md-6 offset-md-3">
    <h1>Reset password form</h1>
    <form action="{{route('password.update')}}" method="post">
    @csrf
    <input type="hidden" name='token' value="{{$token}}">
    <div class="form-group">
    <label for="email">Email address</label>
    <input name = "email" value="{{old('email')}}" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter email">
    @error('email') 
       <div class="invalid-feedback">{{$message}}</div>
    @enderror
  </div>
  
  <div class="form-group">
    <label for="password">Password</label>
    <input name="password" type="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Password">
    @error('password') 
       <div class="invalid-feedback">{{$message}}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="password_confirmation">password_confirmed</label>
    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password">
  </div>  
  <button type="submit" class="btn btn-primary">Reset password</button>
  
</form>
</div>
  </div>
@endsection