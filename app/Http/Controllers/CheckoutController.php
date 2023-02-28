<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $user_id = auth()->user()->id;
        $subtotal = $request->subtotal;
        $user_details = DB::table('users')->select('*')->where(['id' => $user_id])->get()->first();
        return view('checkout', ['userdetails' => $user_details, 'subtotal' => $subtotal]);
    }
}
