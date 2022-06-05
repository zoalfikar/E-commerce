<?php

use App\Models\Category;
use App\Models\CategoryVisit;
use App\Models\Language;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;



// languages
function lang()
{
  return app()->getLocale();
}

function changLang($lang)
{
    app()->setLocale($lang);
}

//store photo

function CategoryPhoto($request)
{
    $file=$request->file('image');
    $ext=$file->getClientOriginalExtension();
    $filename=time().'.'.$ext;
    $file->move(public_path('assets/uploads/category'), $filename);
    return $filename;
}
function productPhoto($request)
{
    $file=$request->file('image');
    $ext=$file->getClientOriginalExtension();
    $filename=time().'.'.$ext;
    $file->move(public_path('assets/uploads/products'), $filename);
    return $filename;
}

function selectLan()
{

    return Language::Active()->get();

}

function langDir()
{
    $lang=Language::Active()->where('abbe',lang())->first();
    return $lang->direction;

}
function isAdmin()
{
    if(Auth::user()->role_as == '1')
    {
        return true;
    }
    else
    {
        return false;
    }

}

function trendingProduct($id)
{
    //Dynamic method for calculating if a product is popular

    $PurchasedPod = Order::select('user_id')->distinct('user_id')->whereNotNull('payment_id')->join('order_items','order_items.order_id','orders.id')->where('prod_id', $id)->count();
    $PurchasedPods = OrderItem::select('prod_id')->distinct('prod_id')->join('orders','orders.id','order_items.order_id')->select('user_id')->whereNotNull('payment_mode')->count();
    if($PurchasedPods==0){return 0;}
    return  $PurchasedPod/$PurchasedPods >= 0.15;
}
function pupularCategory($id)
{
    //Dynamic method for calculating if a category is popular
    $visitedcat=CategoryVisit::where('cat_id',$id)->count();
    $visitedcats=CategoryVisit::all()->count();
    if($visitedcats==0){return 0;}
    return $visitedcat/$visitedcats >= 0.09;
}






