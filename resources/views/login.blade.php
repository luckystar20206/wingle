@extends('components.layout')

@section('css')
    <link rel="stylesheet" href="/css/login.css">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="logo">
                <h1><a href="/" class="logo-name">Wigle</a></h1>
            </div>
            <div class="form-wrapper">

                <form class="login-form" action="" method="post">
                    <div class="header">
                        <h1 class="form-title">Welcome Back!</h1>
                        <p class="sub-title">Please enter your details to login.</p>
                    </div>

                    <input type="email" placeholder="Email*" name="email" class="input" autocomplete="off">
                    <input type="password" placeholder="Password*" name="password" class="input" autocomplete="off">
                    <a href="#" class="forgot-password">Forgot password</a>
                    <input type="submit" name="submit" class="submit-btn" value="Login">

                    <p class="after-form-text">
                        Don't have an account?
                        <span><a href="/register" class="login-link">Sign up</a></span>
                    </p>
                </form>
            </div>
        </div>
        <div class="col" style="margin: 10px">
            <div class="image-wrapper">
                <img class="image" alt="image" src="/images/Login poster.png">
                <a href="#" class="button-link">
                    <button class="login-button">Sign up</button>
                </a>
            </div>
        </div>
    </div>
@endsection
