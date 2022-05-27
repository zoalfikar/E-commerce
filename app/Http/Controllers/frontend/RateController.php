<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    public function rate(Request $request) {

        $rate = new Rate();
        $stars=$request->input('product_rating');
        $prod_id=$request->input('prod-id');
        $prod=Product::where('id', $prod_id)->first();
        if ($prod) {

            $verify_purchase=Order::where('user_id',Auth::id())
            ->join('order_items','orders.id','order_items.order_id')
            ->where('order_items.prod_id',$prod_id)->get();

            if ($verify_purchase->count()>0)
            {
                $exists_rate=Rate::where('user_id',Auth::id())->where('prod_id',$prod_id)->first();
                if ($exists_rate)
                {
                    $exists_rate->rate_value= $stars;
                    $exists_rate->update();
                    return  redirect()->back()->with('status',"thank you for rating this product") ;
                }

                else
                {
                    $rate->user_id=Auth::id();
                    $rate->prod_id=$prod_id;
                    $rate->rate_value=$request->input('product_rating');
                    $rate->save();
                    return  redirect()->back()->with('status',"thank you for rating this product") ;
                }
            }

            else
            {
                return  redirect()->back()->with('status',"you can not rate this product");
            }

        }
        else
        {
            return  redirect()->back()->with('status',"your request faildown");
        }

    }
}
