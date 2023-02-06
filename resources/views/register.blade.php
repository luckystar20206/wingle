@extends('components.layout')
@section('title')
    Register | Wigle
@endsection
@section('css')
    <link rel="stylesheet" href="/css/register.css">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="logo">
                <h1><a href="/" class="logo-name">Wigle</a></h1>
            </div>
            <div class="form-wrapper">

                <form class="register-form" action="/create-account" method="post">
                    @csrf
                    <div class="header">
                        <h1 class="form-title">Create an account</h1>
                        <p class="sub-title">Let's get started by creating an account.</p>
                    </div>

                    <input type="text" placeholder="Name*" name="username" class="input" autocomplete="off" required>
                    <input type="email" placeholder="Email*" name="email" class="input" autocomplete="off" required>
                    <input type="password" placeholder="Password*" name="password" class="input" autocomplete="off" required>
                    <input type="tel" placeholder="Phone*" name="phone" class="input" maxlength="10" autocomplete="off" required>
                    <input type="submit" name="submit" class="submit-btn" value="Create account">

                    <p class="after-form-text">
                        Already have an account?
                        <span><a href="#" class="login-link">Login</a></span>
                    </p>
                </form>
            </div>
        </div>
        <div class="col" style="margin: 10px">
            <div class="image-wrapper">
                <img class="image" alt="image" src="/images/Rectangle 25.png">
                <a href="#" class="button-link">
                    <button class="login-button">Log in</button>
                </a>
            </div>
        </div>
    </div>
@endsection
