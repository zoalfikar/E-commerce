<?php

namespace App\Http\Controllers\frontend;

use App\Events\NewProduct;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use App\Notifications\StoreCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;
use Stevebauman\Location\Facades\Location;

// use Stevebauman\Location\Facades\Location;

class StoresController extends Controller
{
     public function index()
    {
        $stores=Store::where('active','1')->get();
        return view('frontend.stores.SFrontend.index',compact('stores'));
    }

    public function newStore()

    {
        $user=User::where('id',Auth::id())->first();
        return view('frontend.stores.SFrontend.new',compact('user'));
    }

    public function createStore(Request $request)
    {
        $store = new Store();
        if( $request->hasFile('img'))
            {
                $store->img= storelogo($request->file('img'));
            }
        $store->name= $request->input('name');
        $store->slug= $request->input('slug');
        $store->owner_id= Auth::id();
        $store->description= $request->input('description');
        $store->ownerName= $request->input('ownerName');
        $store->active=0;
        $store->populer=0;
        $store->country= $request->input('country');
        $store->city= $request->input('city');
        $store->address_latitude= $request->input('lat');
        $store->address_longitude=$request->input('lng');
        $store->myfatoora_key=Crypt::encrypt($request->input('myfatoora_key'));
        $store->save();
        //sent notification to admins
        $users=User::where("role_as" , "1")->get();
        Notification::send($users, new StoreCreated($store->slug,$store->ownerName));
        return redirect('/stores')->with('status','store create successfully');
    }

    public function storeDetails($slug)
    {
        $store=Store::where('slug',$slug)->first();
        return view('frontend.stores.SFrontend.components.categories',compact('store'));
    }
    public function storeCategoryProducts($Sslug,$Cslug)
    {

        $category=Category::where('slug',$Cslug)->first();
        $store=Store::where('slug',$Sslug)->first();
        return view('frontend.stores.SFrontend.components.products',compact('store','category'));
    }
    public function showCP()
    {
        return view('frontend.stores.SControlPanel.index');

    }

    public function  CategoriesIndex() {
        $store_id=Store::where('owner_id',Auth::id())->pluck('id')->first();
        $categories =Category::where('store_id',$store_id)->get();
        // if (lang()=='ar') {
        //     $categories =Category::ArCat()->get();
        //     return view('arabic.admin.category.index',compact('categories')) ;
        // }
        // else
        // {
            return view('frontend.stores.SControlPanel.category.index',compact('categories')) ;
        // }

    }

   public function addCategory () {
        // if (lang()=='ar') {
        //     return view('arabic.admin.category.addCategory');
        // }
        return view('frontend.stores.SControlPanel.category.addCategory');

    }

    public function editCategory ($id) {
        $category=Category::find($id);
        return view('frontend.stores.SControlPanel.category.editeCategory',compact('category'));

    }

    public function insertCategory ( Request $request) {

        $category = new Category();
        if( $request->hasFile('image'))
            {
                $file=$request->file('image');
                $ext=$file->getClientOriginalExtension();
                $filename=time().'.'.$ext;
                $file->move(public_path('assets/uploads/category'), $filename);
                $category->img= $filename;
            }
        $category->name= $request->input('name');
        //slug shoud be uniqe
        $slug_extention=Store::where('owner_id',Auth::id())->pluck('name')->first();
        $category->slug=$slug_extention.':'.$request->input('slug');
        //
        $category->description= $request->input('description');
        $category->status= $request->input('status')==true?'1':'0';
        $category->populer= $request->input('popular')==true?'1':'0';
        $category->meta_title= $request->input('meta_title');
        $category->meta_kewwords= $request->input('meta_keywords');
        $category->meta_descrip= $request->input('meta_descrip');
        $category->store_id=Store::where('owner_id',Auth::id())->pluck('id')->first();
        $category->languages_abbe=lang();
        $category->save();
        return redirect('/store-panel')->with('status',trans('category.success_add'));


    }


    ////////////   store's proucts

    public function ProductsIndex()
    {

        $all_Products=Product::all();
        $Products=storeProducts($all_Products);
        // if (lang()=='ar') {
        //     $Products=Product::ArProdCat()->get();
        //     return view('arabic.admin.products.index',compact('Products'));
        // }
        return view('frontend.stores.SControlPanel.products.index',compact('Products'));
    }


    public function addProduct() {
        $store=Store::where('owner_id',Auth::id())->first();

        $categories=Category::where('store_id',$store->id)->get();
        // if (lang()=='ar')
        // {
        //     $categories=Category::ArCat()->get();
        //     return view('arabic.admin.products.addProduct',compact('categories'));
        // }
        return view('frontend.stores.SControlPanel.products.addProduct',compact('categories'));

    }


    public function editProduct($id)
    {

        $product=Product::find($id);
        // if (lang()=='ar')
        // {

        //     return view('arabic.admin.products.editProduct',compact('product'));
        // }
        return view('frontend.stores.SControlPanel.products.editProduct',compact('product'));

    }


    public function insertProduct ( Request $request) {

        $product = new Product();
        if( $request->hasFile('image'))
            {
                $file=$request->file('image');
                $ext=$file->getClientOriginalExtension();
                $filename=time().'.'.$ext;
                $file->move(public_path('assets/uploads/product'), $filename);
                $product->img= $filename;
            }
         $product->cat_id= $request->input('cat_id');
         $product->name= $request->input('name');
         //// slug shoud be uniqe
         $category=Category::where('id',$request->input('cat_id'))->first();
         $product->slug=$category->slug.':'.$request->input('slug');
         ////
         $product->small_description= $request->input('small_description');
         $product->description= $request->input('description');
         $product->orginal_price= $request->input('orginal_price');
         $product->selling_price= $request->input('selling_price');
         $product->status= $request->input('status')==true?'1':'0';
         $product->trending= $request->input('trending')==true?'1':'0';
         $product->qty= $request->input('qty');
         $product->tax= $request->input('tax');
         $product->meta_title= $request->input('meta_title');
         $product->meta_descrip= $request->input('meta_descrip');
         $product->meta_kewwords= $request->input('meta_kewwords');
         $product->save();
         event(new NewProduct($category->store->name,$product->name,$product->small_description,$product->description,$product->orginal_price,$product->selling_price,$product->img));
         return redirect('/store-products')->with('status',trans('product.success_add'));

    }
}
