<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
        <link rel="stylesheet" href="/css/nav.css">
    <script defer src="/js/nav.js" type="text/javascript"></script>
</head>

<body>
<nav>
    <div class="nav__left">
        <div class="nav__brand">
            <h1><a href="/">Wigle</a></h1>
        </div>
        <ul class="nav__items" id="navitems">
            <li><a href="/">Home</a></li>
            <li><a href="/#contact">Contact</a></li>
            <li><a href="/products">Products</a></li>
            <li class="cart-sm"><a href="/cart">Cart</a></li>
            @if (auth()->check())
                <li><a href="/account">Account</a></li>
                <li>
                    <form style="margin: 0" action="/logout" method="post">
                        @csrf
                        <button type="submit" class="log-out-btn-sm">Log out</button>
                    </form>
                </li>
            @endif
        </ul>
    </div>
    <div class="nav__right">
        <ul class="nav__items">
            @auth()
                <li>Welcome, {{ auth()->user()->name }}</li>
                {{--                for logging out --}}
                <form style="margin: 0" action="/logout" method="post">
                    @csrf
                    <button type="submit" class="log-out-btn">Log out</button>
                </form>
            @else
                <li><a href="/login">Login</a></li>
            @endauth
            <a href="/cart" class="button__link">
                <button class="cart__button">Cart</button>
            </a>
            <span class="menu material-symbols-outlined" id="menu">
                    menu
                </span>
        </ul>
    </div>
</nav>
</body>

</html>
