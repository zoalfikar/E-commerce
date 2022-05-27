<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function Reviw($slug)
    {

        $prod_chek=Product::where('slug',$slug)->first();
        if ($prod_chek)
        {

        $prod_id=$prod_chek->id;
        $verify_purchase=Order::where('user_id',Auth::id())
            ->join('order_items','orders.id','order_items.order_id')
            ->where('order_items.prod_id',$prod_id)->get();

            return view('frontend.reviews.index', compact('prod_chek','verify_purchase'));

        }
        else

        {
            return redirect()->back()->with('status',"your request faildown");
        }



    }

    public function addReviw(Request $request)
    {

        $prod_id=$request->input('prod_id');
        $prod_chek=Product::where('id',$prod_id)->where('status','0')->first();
        if ($prod_chek)
        {
            $review=Review::where('prod_id',  $prod_chek->id)->where('user_id',Auth::id())->first();

            if ($review)
            {
                $review->user_review=$request->input('user_review');
                $review->save();

            }
            else
            {
                $user_review=$request->input('user_review');
                $new_review=Review::create([
                    'user_id'=> Auth::id(),
                    'prod_id'=>$prod_id,
                    'user_review' => $user_review,
                ]);
            }

            return redirect('/productDetails/'. $prod_chek->Category->slug.'/'.$prod_chek->slug)->with('status',"thank you for review this product");



        }

        else

        {
            return redirect()->back()->with('status',"your request faildown");
        }



    }
    public function editReviw($slug)
    {
        $prod_chek=Product::where('slug',$slug)->first();
        $review=Review::where('prod_id',  $prod_chek->id)->where('user_id',Auth::id())->first();
        if ($prod_chek)
        {

        $prod_id=$prod_chek->id;
        $verify_purchase=Order::where('user_id',Auth::id())
            ->join('order_items','orders.id','order_items.order_id')
            ->where('order_items.prod_id',$prod_id)->get();

            return view('frontend.reviews.edit', compact('prod_chek','verify_purchase','review'));

        }
        else

        {
            return redirect()->back()->with('status',"your request faildown");
        }



    }



}
