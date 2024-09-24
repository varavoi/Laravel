@extends('layouts.main')

@section('title','Register')

@section('content')
    <h1>Register</h1>

 <form action="{{route('user.store')}}" method = "POST">
    <!-- снизу токен -->
    @csrf 
  <div class="form-group my-2">
    <label for="name">Name</label>
    <input name = "name" value="{{old('name')}}" type="text" class="form-control my-1 @error('name') is-invalid @enderror" id="name" aria-describedby="emailHelp" placeholder="Enter name">
    @error('name') 
       <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
  <div class="form-group my-2">
    <label for="email">Email address</label>
    <input name = "email" value="{{old('email')}}" type="email" class="form-control my-1 @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter email">
    @error('email') 
       <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
  <div class="form-group my-2">
    <label for="password">Password</label>
    <input name = "password" type="password" class="form-control my-1 @error('password') is-invalid @enderror" id="password" placeholder="Password">
    @error('password') 
       <div class="invalid-feedback">{{$message}}</div>
    @enderror 
</div>
  <div class="form-group my-2">
    <label for="password_confirmation">Confirm password</label>
    <input name ="password_confirmation" type="password" class="form-control my-1" id="password_confirmation" placeholder="Confirm password">
  </div>
  <a href ="{{route('login')}}">Already registered</a>
  <button type="submit" class="btn btn-primary my-1">Submit</button>
</form>

@endsection