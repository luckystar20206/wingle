<?php

namespace App\Http\Controllers;

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
        $products = DB::select(/** @lang text */ "Select * from products where pincode = '$pincode' and featured = '1'");
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
        $products = DB::select("Select * from products where pincode = '$pincode'");
//        dd($products);
        return view("/products", ["products" => $products]);
    }

    public function productDetail($name, $id)
    {
        $fetchedProduct = DB::table('products')->select('*')->where(['id' => $id, 'product_name' => $name])->get();
        return view('productDetail', ['productinfo' => $fetchedProduct]);
    }

    public function addToCart(Request $request)
    {
        dd($request->all());
    }
}
