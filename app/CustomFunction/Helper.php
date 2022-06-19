<?php

use App\Models\Category;
use App\Models\CategoryVisit;
use App\Models\Language;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Stevebauman\Location\Facades\Location;

// languages
function lang()
{
  return app()->getLocale();
}

function changLang($lang)
{
    app()->setLocale($lang);
}

/////////////////////////////

function CategoryPhoto($img)
{
    $file=$img;
    $ext=$file->getClientOriginalExtension();
    $filename=time().'.'.$ext;
    $file->move(public_path('assets/uploads/category'), $filename);
    return $filename;
}
function productPhoto($img)
{
    $file=$img;
    $ext=$file->getClientOriginalExtension();
    $filename=time().'.'.$ext;
    $file->move(public_path('assets/uploads/products'), $filename);
    return $filename;
}
//store logo
function storelogo($img)
{
    $file=$img;
    $ext=$file->getClientOriginalExtension();
    $filename=time().'.'.$ext;
    $file->move(public_path('assets/uploads/stores'), $filename);
    return $filename;
}

//////////////////////////////
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
{  if(Auth::check())
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
    return false;
}

function trendingProduct($id)
{
    //Dynamic method for calculating if a product is popular

    $PurchasedPod =DB::table('orders')->join('order_items','order_items.order_id','orders.id')->where('order_items.prod_id', $id)->whereNotNull('orders.payment_id')->select('orders.user_id')->distinct('orders.user_id')->count();
    $PurchasedPods =DB::table('order_items')->join('orders','orders.id','order_items.order_id')->select('order_items.prod_id')->distinct('order_items.prod_id')->select('orders.user_id')->whereNotNull('orders.payment_id')->count();
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
function lat($ip)
{
    $data = Location::get($ip);
    if ($data) {
        return $data->latitude;
    }
    return "1";
}
function lng($ip)
{
    $data = Location::get($ip);
    if ( $data ) {
        return $data->longitude;
    }
    return "1";
}
function storeOwner()
{
    $store=Store::where('owner_id',Auth::id())->first();
    if ( $store) {
        return true;
    }
    return false;
}
function isActiveStore($slug)
{
    $store=Store::where('slug',$slug)->first();
    if ( $store) {
        if($store->active==1){return 1 ;}
        return false;
    }
    return 2;
}

/////   Store Products Filter
function StoreproductsFilter($product)
{
    $cat_id=$product['cat_id'];

    if (Category::where('id',$cat_id)->pluck('store_id')->first()== Store::where('owner_id',Auth::id())->pluck('id')->first())
    {
        return true;
    }
    else
    {
        return false;
    }
}

function storeProducts($all_Products)
{
    foreach($all_Products as $object)
    {
        $arrays[] = $object->toArray();
    }
    $f_Products=array_filter($arrays, "StoreproductsFilter");
    $Products=(object)$f_Products;
    foreach ($f_Products as $key => $value)
    {
        $Product = new Product();
        $Product->fill($value);
        $Products->{$key} = $Product;
    }
    return $Products;
}

////////////// end of  Store Products Filter

function userHasStore()
{
    if (Auth::check())
    {
        if (Store::where('owner_id',Auth::id())->exists())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    return 1;

}






