<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;

class RazorpayPaymentController extends Controller
{
    public function index()
    {
        return view('razorpayView');
    }

    public function payment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env("RAZORPAY_API"), env("RAZORPAY_SECRET_KEY"));
        $order = $api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR', 'notes' => array('key1' => 'value3', 'key2' => 'value2')));
        $order_id = $order['id'];

//        Session::put('order_id', $order_id);
//        Session::put('name', $input['name']);
//        Session::put('email', $input['email']);
//        Session::put('amount', $input['subtotal'] * 100);
        $subtotal = $input['subtotal'] * 100;

        return view('/razorpayView', ['name' => $input['name'], 'email' => $input['email'], 'order_id' => $order_id, 'amount' => $subtotal]);
    }
}
