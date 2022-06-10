<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

// use Stevebauman\Location\Facades\Location;

class StoresController extends Controller
{
     public function index()
    {
        return view('frontend.stores.SFrontend.index');
    }
    public function storeDetails(Request $req)
    {
        // $ip ="178.171.171.126";
        // $data = Location::get($ip);
        // dd( $data);
        // return view('frontend.stores.SFrontend.storeDetails');
    }
}
