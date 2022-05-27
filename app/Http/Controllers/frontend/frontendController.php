<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rate;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class frontendController extends Controller
{
    public function index()
    {
        $products=Product::where('trending','1')->take(15)->get();
        $categories=Category::where('populer','1')->take(15)->get();
        return view('frontend.index',compact('products','categories'));
    }

    public function showCategories()
    {
        $categories=Category::where('status','0')->get();
        return view('frontend.categories',compact('categories'));
    }

    public function productsOfCateg($slug)
    {
        if (Category::where('slug',$slug)->exists())
        {
            $category=Category::where('slug',$slug)->first();
            $products=Product::where('cat_id',$category->id)->get();
            return view('frontend.products.productsByCategories',compact('category','products'));
        }

        else
        {
            return redirect('/')->with('status',"category not found");
        }
    }

    public function productDetails($cat_slug,$prod_slug)
    {
        if (Category::where('slug',$cat_slug))
        {
            if (Product::where('slug',$prod_slug))
            {

                $product=Product::where('slug',$prod_slug)->first();
                $Ratings=Rate::where('prod_id',$product->id)->get();
                $user_Rating=Rate::where('prod_id',$product->id)->where('user_id',Auth::id())->get()->first();
                $numberOfRatings= $Ratings->count();
                $sum=Rate::where('prod_id',$product->id)->sum('rate_value');
                $pruduct_rate= 0;
                if ($numberOfRatings!=0)
                {
                    $pruduct_rate= $sum/$numberOfRatings;

                }

                $reviews=Review::where('prod_id',$product->id)->get();
                return view('frontend.products.productDetails',compact('product','numberOfRatings','pruduct_rate','user_Rating','reviews'));


            }
            else
            {
                return redirect('/')->with('status',"pruduct not found");

            }

        }
        else
        {
            return redirect('/')->with('status',"category not found");

        }
    }
}
