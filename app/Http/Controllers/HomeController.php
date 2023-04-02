<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use \App\Models\User;
use  \Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewOrders()
    {
        $user = User::where(['id' => Auth::id()])->first();
        $userData = $user->getOriginal();
        $orders = Orders::where(["uid" => Auth::id()])->orderByDesc('order_no')->get();
        return view('orders', ['orders' => $orders, 'userdata' => $userData]);
    }

    public function contactEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'max:255',],
            'message' => ['required']
        ]);
        if ($validator->fails()) {
            return redirect(url()->previous() .'#contact')
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->first_name. " " . $request->last_name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Mail::to('archanrd29@gmail.com')->send(new ContactMail($data));
        return redirect()->to('/#contact')->with(['success' => 'Message sent successfully']);
    }

}
