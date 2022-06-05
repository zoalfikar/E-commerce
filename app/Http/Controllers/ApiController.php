<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{


    public function products($id=null ,Request $req)
    {

        if  ($req->has('name'))
        {
            if ($pro= Product::where('name','LIKE','%'.$req['name'].'%')->first())
            {
                return $pro;
            }
            else
            {
                return response()->json(["messege"=>"product not found"]);
            }

        }

        if ( $id != null )
        {
            if ($pro= Product::find($id))
            {
                return $pro;
            }
            else
            {
                return response()->json(["messege"=>"product not found"]);
            }


        }

        return Product::all();
    }
    public function addInfoProduct()
    {
       $cat=Category::select('name','id')->get();
       return response()->json(["messege"=>"choose the cat_id of the category you want include the product in -_*", $cat]);
    }
    public function addProduct(Request $request)
    {

        if(!Category::where('id',$request->input('cat_id')) )
        {
            $cat=Category::select('name','id')->get();
            return response()->json(["messege"=>"choose the id of the category you want include the product in -_*", $cat]);
        }
        $product = new Product();
        if( $request->hasFile('image'))
            {
                $product->img= productPhoto($request);
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
         return response()->json(["messege"=>"your product added successfully"]);

    }




}
