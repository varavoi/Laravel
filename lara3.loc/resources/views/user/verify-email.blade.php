@extends('layouts.main')

@section('title','Verify email')

@section('content')
<div class="alert alert-info" role="alert">
    Проверьте почту для подтверждения регистрации
</div>
<div class="alert alert-info" role="alert">
    Отправить письмо еще реализовать
    <form method="post" action="{{route('verification.send')}}">
    @csrf
    <button type="submit" class="btn btn-primary">Отправить еще раз</button>
    </form>
</div>
@endsection