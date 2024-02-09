<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $user_id = auth()->user()->id;
        $subtotal = $request->subtotal;
        $user_details = User::where(['id' => $user_id])->first();
        $cartItems = Cart::where(['uid' => Auth::id()])->get();
        return view('checkout', ['userdetails' => $user_details, 'subtotal' => $subtotal, 'cartItems' => $cartItems]);
    }

}
