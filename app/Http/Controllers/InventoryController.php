<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function viewInventoryForm()
    {
        return view('add_inventory_item');
    }

    public function storeToInventory(Request $request)
    {
        $data = $request->validate([
            'product_name' => ['max:50', 'required', 'string'],
            'product_image' => ['required'],
            'product_price' => ['required', 'integer'],
            'product_size' => ['required'],
            'product_category' => ['string', 'required'],
            'product_stock' => ['integer', 'required'],
        ]);

        $image = $request->file('product_image');
        $image_name = $image->getClientOriginalName();
        $image->move('public/images', $image_name);

//        dd($data['product_size']);

        $item = new Inventory;
        $item->p_name = $data['product_name'];
        $item->p_image = $image_name;
        $item->p_price = $data['product_price'];
        $item->p_category = $data['product_category'];
        $item->p_size = json_encode($data['product_size']);
        $item->p_stock = $data['product_stock'];
        $item->save();

//        $image->store('images', 'public');
    }
}
