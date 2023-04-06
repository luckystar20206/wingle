<?php

namespace App\Http\Controllers;

use App\Mail\sendMailOnCheckout;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Doctrine\DBAL\Driver\PDO\Exception;
use Egulias\EmailValidator\Result\Reason\AtextAfterCFWS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;

class RazorpayPaymentController extends Controller
{
    public function index()
    {
        return view('razorpayView');
    }

    public $api;

    public function __construct()
    {
        $this->api = new Api("rzp_test_xmkWmjAvPDr7gx", "cJBQ8JPQnwIutI5fEbK7NvK4");
    }

    public function makeOrder(Request $request)
    {
        $user = User::where(['id' => Auth::id()])->get();
        $userinfo = $user[0]->getOriginal();
        $input = $request->all();
        $api = new Api(env("RAZORPAY_API"), env("RAZORPAY_SECRET_KEY"));
        $orderData = [
            'receipt' => 'rcptid_11',
            'amount' => $input['subtotal'] * 100,
            'currency' => 'INR'
        ];

        $razorpayOrder = $api->order->create($orderData);

        User::where(['id' => Auth::id()])->update(['address' => $request->address]);

        return view('/razorpayView', ['razorpayOrder' => $razorpayOrder, 'name' => $userinfo['name'], 'email' => $userinfo['email'], 'phone' => $userinfo['phone']]);
    }

    public function success(Request $request)
    {
        $status = $this->api->payment->fetch($request->payment_id);
        $user = User::where(['id' => Auth::id()])->first();
        $userdetails = $user->getOriginal();

        if ($status['status'] == "authorized") {
            $cartItems = Cart::where(['uid' => Auth::id()])->get();

            $num_of_items = Cart::where(['uid' => Auth::id()])->count();
            $orderID = rand(1111, 9999);
            $p_name = array();
            $p_category = array();
            $p_qty = array();
            $p_rent_period = array();

            foreach ($cartItems as $item) {
                $p_name[] = $item->pname;
            }
            foreach ($cartItems as $item) {
                $p_category[] = $item->category;
            }
            foreach ($cartItems as $item) {
                $p_qty[] = $item->qty;
            }
            foreach ($cartItems as $item) {
                $p_rent_period[] = $item->rent_period;
            }

            $user = User::where(['id' => Auth::id()])->first();

            $prod_name = json_encode($p_name);
            $category = json_encode($p_category);
            $qty = json_encode($p_qty);
            $rent_period = json_encode($p_rent_period);

            $order = new Orders();
            $order->order_id = $orderID;
            $order->payment_id = $request->payment_id;
            $order->uid = Auth::id();
            $order->pname = $prod_name;
            $order->category = $category;
            $order->qty = $qty;
            $order->rent_period = $rent_period;
            $order->address = $userdetails['address'];
            $order->cart_total = $status['amount'];
            $order->ordered_at = Carbon::now()->toDateTimeString();
            $order->save();

            Cart::where(['uid' => Auth::id()])->delete();

            // update a stock by minus 1 in products of pincode 
            Product::where(['pid' => $item->pid, 'pincode' => $cartItems[0]->pincode])->decrement('stock');

            Mail::to($user->email)->send(new sendMailOnCheckout());
            return redirect('/cart')->with(['order-confirmed' => "Your order is placed."]);
        }
        return redirect()->to("/cart")->with(['failed' => 'Payment failed']);
    }
}
