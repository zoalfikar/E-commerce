<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class frontendController extends Controller
{
    public function index()
    {
        $products=Product::where('trending','1')->take(15)->get();
        return view('frontend.index',compact('products'));
    }
}
