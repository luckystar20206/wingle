@extends('components.layout')

@section("css")
    <link rel="stylesheet" href="/css/contact.css">
@endsection
@section("title")
    Contact | Wigle
@endsection

@section('content')
    @include('nav')

    <div class="contact">
        <h1 class="title">Love to hear from you,<br>Get in touch👋</h1>

        <form class="contact-frm" method="POST" action="">
            <div class="form-group flex">
                <input type="text" class="input flex-1" id="" name="First_name" placeholder="First name"/>
                <input type="text" class="input flex-1" id="" name="Last_name" placeholder="Last name"/>
            </div>
            <div class="form-group">
                <input type="email" class="input" id="" name="email" placeholder="Email address"/>
            </div>
            <div class="form-group">
                <textarea name="message" class="message-box" rows="8" placeholder="Message"></textarea>
            </div>
            <button type="submit" class="submit-btn">
                <span>Submit</span>
                <span>Submit</span>
            </button>
        </form>
    </div>
@endsection
