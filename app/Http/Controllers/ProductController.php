<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\json_encode;

class ProductController extends Controller
{

    public function index()
    {
        $pincode = Session::get("pincode");
        $products = DB::select(/** @lang text */ "Select * from product where pincode = '$pincode' and featured = '1'");
        return view('home', ['products' => $products]);
    }

    public function createproduct()
    {
        return view("add_product");
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'price' => ['required', 'integer'],
            'image' => ['file'],
            'pincode' => ['required', 'max:6'],
            'featured' => ['required'],
            'size' => ['required'],
        ]);

        if ($request->hasFile("product_image")) {
            $image = $request->file("product_image");
            $image_name = $image->getClientOriginalName();
            $image->storeAs('/public/images', $image_name);

            $product = new Product();
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->image = $image_name;
            $product->pincode = $request->pincode;
            $product->featured = $request->featured;
            $product->size = json_encode($request->size);
            $product->category = $request->category;
            $product->save();
            return redirect()->to('/add-product')->with('success', 'Product added successfully');
        } else {
            return dd('failed to add, try again');
        }
    }

    public function showProducts()
    {
        $pincode = Session::get("pincode");
        $products = DB::select(/** @lang text */ "Select * from product where pincode = '$pincode'");
//        dd($products);
        return view("/products", ["products" => $products]);
    }

    public function productDetail($name, $id)
    {
        $fetchedProduct = DB::table('product')->select('*')->where(['id' => $id, 'product_name' => $name])->get();
        return view('productDetail', ['productinfo' => $fetchedProduct]);
    }

    public function addToCart(Request $request)
    {
        $size = $request->size;
        $qty = $request->quantity;
        $pid = $request->product_id;
        $uid = auth()->user()->id;

        $product = DB::table('product')->select('*')->where(['id' => $pid])->get()->first();
        $cartItem = new Cart();
        $cartItem->pid = $pid;
        $cartItem->uid = $uid;
        $cartItem->pname = $product->product_name;
        $cartItem->image = $product->image;
        $cartItem->price = $product->price;
        $cartItem->size = $size;
        $cartItem->category = $product->category;
        $cartItem->qty = $qty;
        $cartItem->rent_period = 1;
        $cartItem->save();
        return redirect()->back()->with(['itemAdded' => "Item added to cart"]);
    }

    public function viewCart()
    {
        $cart_number_of_items = DB::table('cart')->count();
        if ($cart_number_of_items > 0) {
            $cart_items = DB::table('cart')->select('*')->where(['uid' => auth()->user()->id])->get();
            return view('cart', ['cart_items' => $cart_items]);
        } else {
            return view('cart_empty');
        }
    }

    public function updateRentPeriod(Request $request)
    {
//        dd($request->all());
        $uid = auth()->user()->id;
        $rentPeriod = DB::update("update cart set rent_period = '$request->rent_period' where pid = '$request->pid' and uid = '$uid'");
        return redirect()->back();
    }

    public function itemQuantity(Request $request)
    {
//        dd($request->all());
        $uid = auth()->user()->id;
        $quantity = DB::update("update cart set qty = '$request->qty' where pid = '$request->pid' and uid = '$uid'");
        return redirect()->back();
    }

    public function filter($filter)
    {
        dd($filter);
    }
}
