@php use Illuminate\Support\Facades\Session; @endphp
@extends('components.layout')
@section('js')
    <script src="{{ asset('/js/pay.js') }}"></script>
@endsection
@section('content')
    <button style="display: none" id="rzp-button1">Pay</button>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{env("RAZORPAY_API")}}", // Enter the Key ID generated from the Dashboard
            "amount": "{{ Session::get('amount') }}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
            "name": "Wigle Clothes", //your business name
            "description": "Test Transaction",
            "image": "",
            "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
            "prefill": {
                "name": "{{ Session::get('name') }}", //your customer's name
                "email": "{{ Session::get('email') }}",
                "contact": "9000090000"
            },
            "notes": {
                "address": "Vadodara, Gujarat, India"
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function (e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>
@endsection
