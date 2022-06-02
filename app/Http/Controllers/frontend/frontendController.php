<?php

namespace App\Http\Controllers\frontend;

use App\Events\UserComplain;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Rate;
use App\Models\Review;
use App\Rules\messegeLength;
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
        if (lang()=='ar')
        {
            $categories=Category::where('status','0')->ArCat()->get();
            return view('arabic.frontend.categories',compact('categories'));
        }
        return view('frontend.categories',compact('categories'));
    }

    public function showAllCategories()
    {
        $categories=Category::where('status','0')->get();
        // $categories=allWoutRepeat();
        if (lang()=='ar')
        {

        return view('arabic.frontend.categories',compact('categories'));
        }
        return view('frontend.categories',compact('categories'));
    }

    public function productsOfCateg($slug)
    {
        if (Category::where('slug',$slug)->exists())
        {
            if (lang()=='ar')
            {
                $category=Category::where('slug',$slug)->ArCat()->first();
                $products=Product::where('cat_id',$category->id)->get();
                $categories=Category::where('status','0')->ArCat()->get();
                return view('arabic.frontend.products.productsByCategories',compact('category','products'));
            }
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

    public function searchForProducts()
    {
        $products=Product::select('name')->where('status','0')->get();
        $categories=Category::select('name')->where('status','0')->get();
        $data_p=[];
        foreach($products as $product)
        {
            $data_p[]= $product['name'];
        }

        foreach($categories as $category)
        {
            $data_c[]= $category['name'];
        }

        return $data=array_merge($data_p,$data_c);
    }

    public function getProduct(Request $request)
    {
        $product_search=$request->input('search');
        $category_search=$request->input('search');
        if ($product_search != '') {
            $product=Product::where("name","LIKE","%$product_search%")->first();
            if ($product)
            {
                return redirect('/productDetails/'.$product->category->slug.'/'.$product->slug);
            }
            else
            {
                $category=Category::where("name","LIKE","%$category_search%")->first();
                if ($category)
                {
                    return redirect('/productsOfCateg/'.$category->slug);
                }
                else
                {
                    return redirect()->back()->with('status',"your search machs nothings");
                }

            }

        }
        else
        {
            return redirect()->back();
        }
    }

    public function complain ($id)
    {

        $product=Product::find($id);
        if ($product)
        {
            $verify_purchase=Order::where('user_id',Auth::id())
            ->join('order_items','orders.id','order_items.order_id')
            ->where('order_items.prod_id',$product->id)->get();
            if ($verify_purchase->count()>0) {
                return view('frontend.complaints.complaint',compact('product'));
            }
            else
            {
                return redirect()->back()->with('status',"you cant complain about this");
            }
        }

        else

        {
            return redirect()->back()->with('status',"your request faildown");
        }



    }

    public function sendComplain(Request $request)

    {

        $validation=$request->validate([
            'complain'=> ['required', new messegeLength ]
        ]);

        event(new UserComplain($request->input('complain'),$request->input('prod_id')));

        return redirect()->back()->with('status',"your complaint has been sent");

    }
}
