<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AreaController extends Controller
{
    public function searchArea(Request $request)
    {
        session()->forget('area');
        $area_name = DB::table('pincodes')->select("*")->where('pincode', '=', $request->pincode)->get();

        $products = DB::table("products")->select("*")->where(["pincode" => $request->pincode, "featured" => true])->get();
        
        foreach ($area_name as $area) {
            Session::put("area", $area->area_name);
            Session::put("pincode", $area->pincode);
            Session::put("products", $products);

            return redirect('/products');
        }
        $message = "Sorry! we are not yet in this area";
        return redirect()->to('/#getting-started')->with(['error_area' => $message]);
    }

    public function create()
    {
        return view('add_area');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'area_name' => 'required',
        ]);

        $area = new Area;
        $area->area_name = $request->area_name;
        $area->save();
        return redirect('/add-area')->with('added');
    }
}
