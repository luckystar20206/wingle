@extends("components.layout")

@section("css")

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/landing.css') }}">

@endsection

@section("title")

    Home | Wigle

@endsection

@section('scriptjs')
    <script type="text/javascript">
        let spinner = document.querySelector('.loader');
        let buttontxt = document.querySelector('.text');
        let button = document.querySelector('.c-send-button');

        button.addEventListener('click', function () {
            buttontxt.innerHTML = "";
            spinner.classList.remove('d-none');
        });
    </script>
@endsection

@section("content")

    @include("nav")

    <header>
        <div class="hero">
            <h1 class="hero-title">Experience the <span class="bg-splash">fashion</span> without purchasing!</h1>
            <div class="button-wrapper"><a href="#getting-started" class="get-started-btn">Get started</a></div>
        </div>
    </header>

    <section class="pincode-wrapper" id="getting-started">
        <h1 class="heading">We use pincode to detect the location</h1>
        <div class="pincode-section">
            <div class="container">
                <div class="box box-black">
                    <h1>Select. <br> Add. <br> Rent.<br></h1>
                </div>
                <div class="box box-white">
                    <div class="pincode-box">
                        <img class="binocular-img" src="{{ asset('/images/searching.png')}}" alt="searching-image">
                        <div class="form-wrapper">
                            <form action="{{ route('search-pincode') }}">
                                <label for="pincode-input">Enter the pincode of your area</label>
                                <input type="number" id="pincode-input" name="pincode" @if(session()->has('pincode')) ?
                                       value="{{ session()->get('pincode')}}" : value="" @endif class="form-control"
                                       placeholder="Example: 390010" / required>
                                <button type="submit">View products</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section" id="contact">
        <div class="contact-container">
            <h1 class="heading">Contact us</h1>
            <p class="info">Send us an email, we will try to respond you as soon as possible. Generally the response may
                take up to 2 working days.</p>
            <p class="required-txt">* Indicates required field.</p>
            <div class="c-form-wrapper">
                <form action="/send-mail" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" placeholder="First name*" name="first_name" class="form-control"/>
                    </div>
                    @error('first_name')
                    <p style="color: red; margin: 2px 0;">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <input type="text" placeholder="Last name*" name="last_name" class="form-control"/>
                    </div>
                    @error('last_name')
                    <p style="color: red; margin: 2px 0;">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <input type="email" placeholder="Email address*" name="email" class="form-control"/>
                    </div>
                    @error('email')
                    <p style="color: red; margin: 2px 0;">{{ $message }}</p>
                    @enderror
                    <div class="form-group">
                        <textarea placeholder="Message*" name="message" class="form-control"></textarea>
                    </div>
                    @error('message')
                    <p style="color: red; margin: 2px 0;">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="c-send-button">
                        <span class="loader d-none"></span>
                        <span class="text"> Send Message </span>
                    </button>
                </form>
                @if(session()->has('success'))
                    <p style="font-family: 'Poppins', sans-serif; font-weight: 500">{{ session()->get('success') }}</p>
                    @php session()->remove('success') @endphp
                @endif
            </div>
        </div>
        <div class="img-col">
            <img src="{{ asset('/images/image 3.png') }} " alt="image"/>
        </div>
    </section>

@endsection
