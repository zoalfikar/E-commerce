<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
class CartController extends Controller
{

    public function showCart () {
        $cartIteams=Cart::where('user_id',Auth::id())->get() ;
        if(lang()=='ar')
        {
            return view('arabic.frontend.cart',compact('cartIteams'));
        }
        return view('frontend.cart',compact('cartIteams'));

    }

    public function addProduct (Request $request )
    {
         $product_id = $request->input('product_id');
         $product_qty = $request->input('product_qty');

        if (Auth::check())
        {
            $prod_check = Product::where('id', $product_id)->first();

            if ($prod_check) {
                    if (Cart::where('prod_id',$product_id)->where('user_id', Auth::id())->exists())
                    {
                        return response()->json(['status'=> $prod_check->name." already exists "]);

                    }
                    else
                    {
                        $cartIteam = new Cart();
                        $cartIteam->prod_id = $product_id;
                        $cartIteam->prod_qty = $product_qty;
                        $cartIteam->user_id=  Auth::id();
                        $cartIteam->save();
                        return response()->json(['status'=>$prod_check->name." added to cart"]);
                    }
            }

            else
            {
                return response()->json(['status'=>"product not found"]);
            }



        }

        else

        {
            return response()->json(['status'=>"login to continue"]);
        }


    }


    public function updateProduct(Request $request) {

        $prod_id=$request->input('prod_id');
        $qty=$request->input('qty');

        if (Auth::check())
        {

            if ($prod_check = Cart::where('prod_id', $prod_id)->where('user_id',Auth::id())->exists())
            {
                $cartIteam=Cart::where('prod_id', $prod_id)->where('user_id',Auth::id())->first();
                $cartIteam->prod_qty=$qty;
                $cartIteam->save();
            }

            else
            {
                return response()->json(['status'=>"product not found"]);
            }

        }

        else

        {
            return response()->json(['status'=>"login to continue"]);
        }


    }

    public function deletProduct (Request $request )
    {

         $product_id = $request->input('prod_id');

        if (Auth::check())
        {

            if ($prod_check = Cart::where('prod_id', $product_id)->where('user_id',Auth::id())->exists())
            {
                $cartIteam=Cart::where('prod_id', $product_id)->where('user_id',Auth::id())->first();
                $cartIteam->delete();
                return response()->json(['status'=>$cartIteam->Product->name."has deleted"]);
            }

            else
            {
                return response()->json(['status'=>"product not found"]);
            }

        }

        else

        {
            return response()->json(['status'=>"login to continue"]);
        }

    }

    public function CartCount ()
    {
        $count=Cart::where('user_id',Auth::id())->count();
        return response()->json(['status'=>$count]);
    }
}
