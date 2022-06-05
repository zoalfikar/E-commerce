<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;

class ProductController extends Controller
{
    //proucts

    public function index() {

        $Products=Product::all();

        if (lang()=='ar') {
            $Products=Product::ArProdCat()->get();
            return view('arabic.admin.products.index',compact('Products'));
        }
        return view('admin.products.index',compact('Products'));

    }


     public function addProduct() {

        $categories=Category::all();
        if (lang()=='ar')
        {
            $categories=Category::ArCat()->get();
            return view('arabic.admin.products.addProduct',compact('categories'));
        }

        return view('admin.products.addProduct',compact('categories'));

    }


    public function editProduct($id)
    {

        $product=Product::find($id);
        if (lang()=='ar')
        {

            return view('arabic.admin.products.editProduct',compact('product'));
        }
        return view('admin.products.editProduct',compact('product'));

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
         $product->slug= $request->input('slug');
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
         return redirect('/products')->with('status',trans('product.success_add'));

    }


        public function updateProduct ( Request $request , $id) {

            $product =Product::find($id);
            if( $request->hasFile('image'))
                {
                    $path= 'assets/uploads/product/'.$product->img;
                    if (File::exists($path))
                        {
                            File::delete($path);
                        }
                    $file=$request->file('image');
                    $ext=$file->getClientOriginalExtension();
                    $filename=time().'.'.$ext;
                    $file->move(public_path('assets/uploads/product'), $filename);
                    $product->img= $filename;
                }
            $product->name= $request->input('name');
            $product->slug= $request->input('slug');
            $product->description= $request->input('description');
            $product->small_description= $request->input('small_description');
            $product->orginal_price= $request->input('orginal_price');
            $product->selling_price= $request->input('selling_price');
            $product->status= $request->input('status')==true?'1':'0';
            $product->trending= $request->input('trending')==true?'1':'0';
            $product->meta_title= $request->input('meta_title');
            $product->meta_kewwords= $request->input('meta_kewwords');
            $product->meta_descrip= $request->input('meta_descrip');
            $product->update();
            return redirect('/products')->with('status',trans('product.success_update'));

        }



        public function deleteProduct($id) {
            $product=Product::find($id);
            if ($product->img)
                {
                    $path='assets/uploads/product/'.$product->img;
                    if (File::exists($path))
                        {
                            File::delete($path);
                        }
                }
            $product->delete();
            return redirect('products')->with('status',trans('product.success_delete'));

        }

        public function transletIndexProduct($id,$abbe)
        {
            if ($abbe!==lang())  //Check that the translation is not in the same language
            {
                $product=Product::find($id);
                $categories=Category::all();
                $trans=false;
                $idtrans='';
                foreach ($categories as $category) // check if categor of this has been translated
                {
                    if ($category->id== $product->category->translation_of) {
                        $trans=true;
                        $idtrans=$category->id;
                    }

                    if($category->translation_of== $product->category->id)
                    {
                        $idtrans=$category->id;
                        $trans=true;
                    }
                }
                if($trans)
                {
                    $transcategory=Category::find($idtrans);
                    return view('admin.products.transelate' , compact('product','transcategory'));
                }
                else
                {
                    return redirect()->back()->with('status','translet category first');
                }

            }
            else
            {
                return redirect()->back()->with('status',trans('product.translete_errore'));
            }
        }
        public function transelateProduct ()
        {

        }
        public function trendingProduct(Request $req)
        {
            $order=Order::where('payment_id',$req->payment_id)->first();
            foreach ($order->OrderItems as $produt ) {
                if(trendingProduct($produt->prod_id))
                {
                    $produt->trending=1;
                    $produt->save();
                }
            }


        }
        public function activeCategory(Request $req)
        {
            $cat=Product::find($req->prod_id);
            $cat->status='0';
            $cat->save();
            return response()->json();
        }
        public function preventCategory(Request $req)
        {
            $cat=Product::find($req->prod_id);
            $cat->status='1';
            $cat->save();
            return response()->json();
        }

}
