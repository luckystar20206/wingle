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
        $products = DB::table('products')->select('*')->where(['pincode' => $pincode, 'featured' => '1'])->get();
        return view('home', ['products' => $products]);
    }

    public function createproduct()
    {
        $inventory = DB::table("inventories")->select("*")->get();
        $pincodes = DB::table("pincodes")->select("*")->get();
        return view("add_product", ["inventory" => $inventory, "pincode" => $pincodes]);
    }

    public function store(Request $request)
    {

        $data = request()->validate([
            'pid' => ['integer'],
            'pincode' => ['integer'],
        ]);

        //check db products if item is already added or not

        if(DB::table("products")->select("pid")->where(["pid" => $data['pid'], "pincode" => $data['pincode']])->exists()){
            return redirect()->to('/add-product')->with("message", "Item already added");
        }else{


        //fetches the product details using the pid.

        $inventory_item = DB::table("inventories")->select("*")->where(["pid" => $data['pid']])->get();


        $product = new Product();
        $product->pid = $inventory_item[0]->pid;
        $product->p_name = $inventory_item[0]->p_name;
        $product->p_image = $inventory_item[0]->p_image;
        $product->p_price = $inventory_item[0]->p_price;
        $product->p_category = $inventory_item[0]->p_category;
        $product->p_size = $inventory_item[0]->p_size;
        $product->pincode = $data['pincode'];
        $product->featured = true;
        $product->stock = $inventory_item[0]->p_stock;
        $product->save();

        return redirect()->to('/add-product')->with('message', 'Product added successfully');

        }
    }

    public function showProducts()
    {
        $pincode = Session::get("pincode");

        $products = DB::table("products")->select("*")->where(["pincode" => $pincode])->get();

        return view("/products", ["products" => $products]);
    }

    public function productDetail($name, $id)
    {
        $fetchedProduct = DB::table('products')->select('*')->where(['pid' => $id, 'p_name' => $name])->get();
        return view('productDetail', ['productinfo' => $fetchedProduct]);
    }

    public function addToCart(Request $request)
    {
        $size = $request->size;
        $qty = $request->quantity;
        $pid = $request->product_id;
        $uid = auth()->user()->id;

        if (DB::table('cart')->select('*')->where('pid', $pid)->exists()) {
            return redirect()->back()->with('exists', 'Item already added');
        } else {

            $product = DB::table('products')->select('*')->where(['pid' => $pid])->get()->first();
            $cartItem = new Cart();
            $cartItem->pid = $pid;
            $cartItem->uid = $uid;
            $cartItem->pname = $product->p_name;
            $cartItem->image = $product->p_image;
            $cartItem->price = $product->p_price;
            $cartItem->size = $size;
            $cartItem->category = $product->p_category;
            $cartItem->qty = $qty;
            $cartItem->rent_period = 1;
            $cartItem->save();
            return redirect()->back()->with(['itemAdded' => "Item added to cart"]);

        }
    }

    public function viewCart()
    {
        $cart_number_of_items = DB::table('cart')->count();
        $num_of_items = Cart::count();
        if ($cart_number_of_items > 0) {
//            $cart_items = DB::table('cart')->select('*')->where(['uid' => auth()->user()->id])->get();
            $cart = Cart::all();
            return view('cart', ['cart_items' => $cart, 'items_in_cart' => $num_of_items]);
        } else {
            return view('cart_empty');
        }
    }
    public function updateRentPeriod(Request $request)
    {
        dd($request->all());
        $uid = auth()->user()->id;
        $rentPeriod = DB::update("update cart set rent_period = '$request->rent_period' where pid = '$request->pid' and uid = '$uid'");
        return redirect()->back();
    }

    public function itemQuantity(Request $request)
    {
        dd($request->all());
        DB::table('cart')->where(['pid' => $request->pid])->update(['qty' => $request->qty]);
        return redirect()->to('/cart');
    }

    public function filter($filter)
    {
        dd($filter);
    }

    public function listProducts()
    {
        $products = DB::table('product')->select('*')->get();
        return view('updateProduct', ['products' => $products]);
    }

    public function updateProduct(Request $request)
    {
        $update = DB::table('product')->where('id', $request->pid)->update(['product_name' => $request->product_name, 'price' => $request->product_price]);
        return redirect()->back();
    }

    public function removeItemFromCart(Request $request){
        $pid = $request->pid;
        DB::table('cart')->where(['pid' => $pid])->delete();
        return redirect()->to('/cart');
    }
}
