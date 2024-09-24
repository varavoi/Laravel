@extends('layouts/main')

@section ('title', 'Forgot password')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
    <h1>Forgot password</h1>
    <form action="{{route('password.email')}}" method="post">
    @csrf
    <div class="form-group">
    <label for="email">Email address</label>
    <input name = "email"  type="email" class="form-control " id="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <button type="submit" class="btn btn-primary">Send Link</button>
</form>
</div>
  </div>
@endsection
