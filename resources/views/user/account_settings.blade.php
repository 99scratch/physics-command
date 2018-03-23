@extends('layouts.app')

@section('container')
    <form action="{{ url('/user/account/settings/update') }}" method="post">
        <label class="label_connect">Custom header key</label>
        <small>(This protection has been used when hardware interact with panel)</small>
        <input type="text" name="account_header" placeholder="05a671c66aefea124cc08">

        <label class="label_connect">Current password</label>
        <input type="password" name="user_password" placeholder="*********">

        {{ csrf_field() }}

        <label class="label_connect">New password</label>
        <input type="password" name="user_password_new" placeholder="*********">

        <input type="submit" class="physics_button" name="update" value="Update" />
    </form>
@endsection