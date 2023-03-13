@php use Illuminate\Support\Facades\Session; @endphp
@extends('components.layout')
@section('js')
    <script src="{{ asset('/js/pay.js') }}"></script>
@endsection
@section('content')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        let urls = "{{ route('success') }}";
        let options = {
            "key": "{{env("RAZORPAY_API")}}", // Enter the Key ID generated from the Dashboard
            "amount": "100", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
            "name": "Wigle Clothes", //your business name
            "description": "Thanks for choosing us",
            "image": "",
            "handler": function (response) {
                window.location.href = urls+'?payment_id='+response.razorpay_payment_id
            },
            "prefill":
                {
                    "name": "{{ Session::get('name') }}",
                    "email": "{{ Session::get('email') }}",
                    "phone": "{{ Session::get('phone') }}"
                },
            "theme":
                {
                    "color":
                        "#022bff"
                }
        };
        let rzp1 = new Razorpay(options);
        rzp1.open();
    </script>
@endsection
