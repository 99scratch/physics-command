@extends('layouts.appconnect')

@section('container')
    <form action="{{ url('/user/login') }}" method="post">
        <label class="label_connect">Username</label>
        <input type="text" name="username" placeholder="Physics">

        <label class="label_connect">password</label>
        <input type="password" name="password" placeholder="******">

        {{ csrf_field() }}

        <hr />
        <input type="submit" class="physics_button" name="login" value="Login" />
    </form>
@endsection