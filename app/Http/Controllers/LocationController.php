<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $userIp = '106.222.6.188';
        $locationData = \Stevebauman\Location\Facades\Location::get($userIp);

        dd($locationData);
    }
}
