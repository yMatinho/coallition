@extends('layouts.login')

@section('content')
    <div class="login-box">
        @foreach($errors->all() as $error)
            <p class="error-message">{{ $error }}</p>
        @endforeach
        <form method="POST" action="{{ route('login.login') }}">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <input type="submit" name="action" value="Login">
            </div>
        </form>
    </div>
@endsection
