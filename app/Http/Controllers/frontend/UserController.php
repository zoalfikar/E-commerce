<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index ()
    {
        $orders=Order::where('user_id',Auth::id())->get();
        if (lang()=='ar')
        {
            return view('arabic.frontend.orders',compact('orders'));
        }
        return view('frontend.orders', compact('orders'));
    }

    public function orderDetails ($id)
    {
        $orders=Order::where('id',$id)->first();
        if (lang()=='ar')
        {
            return view('arabic.frontend.orderDetails', compact('orders'));
        }
        return view('frontend.orderDetails', compact('orders'));
    }
}
