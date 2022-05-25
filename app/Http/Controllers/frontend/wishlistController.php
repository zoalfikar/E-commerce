<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class wishlistController extends Controller
{

    public function wishlist () {

        $prods=wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist',compact('prods'));
    }

    public function addTOwishlist (Request $request)
    {

        $product_id = $request->input('product_id');

        if (Auth::check())
        {
            $prod_check = Product::where('id', $product_id)->first();

            if ($prod_check) {
                    if (wishlist::where('prod_id',$product_id)->where('user_id', Auth::id())->exists())
                    {
                        return response()->json(['status'=> $prod_check->name." already exists "]);

                    }
                    else
                    {
                        $wishlistIteam = new wishlist();
                        $wishlistIteam->prod_id = $product_id;
                        $wishlistIteam->user_id=  Auth::id();
                        $wishlistIteam->save();
                        return response()->json(['status'=>$prod_check->name." added to whishlis"]);
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

    public function deletFromWishlis (Request $request )
    {

         $product_id = $request->input('prod_id');

        if (Auth::check())
        {

            if ($prod_check = wishlist::where('prod_id', $product_id)->where('user_id',Auth::id())->exists())
            {
                $wishlistIteam=wishlist::where('prod_id', $product_id)->where('user_id',Auth::id())->first();
                $wishlistIteam->delete();
                return response()->json(['status'=>$wishlistIteam->Product->name."has deleted"]);
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
    public function wishlistCount ()
    {
        $count=wishlist::where('user_id',Auth::id())->count();
        return response()->json(['status'=>$count]);
    }

}
