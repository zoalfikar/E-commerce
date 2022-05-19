<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryConroller extends Controller
{
    //categories
   public function  index() {

        $categories =Category::all();
        return view('admin.category.index',compact('categories')) ;

    }

   public function addCategory () {

        return view('admin.category.addCategory');

    }

   public function editCategory ($id) {

       $category=Category::find($id);
        return view('admin.category.editeCategory',compact('category'));

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
        $category->slug= $request->input('slug');
        $category->description= $request->input('description');
        $category->status= $request->input('status')==true?'1':'0';
        $category->populer= $request->input('popular')==true?'1':'0';
        $category->meta_title= $request->input('meta_title');
        $category->meta_kewwords= $request->input('meta_keywords');
        $category->meta_descrip= $request->input('meta_descrip');
        $category->save();
        return redirect('/dashboard')->with('status','data inserted successfully');


    }


    public function updateCategory ( Request $request , $id) {

        $category =Category::find($id);
        if( $request->hasFile('image'))
            {
                $path= 'assets/uploads/category/'.$category->img;
                if (File::exists($path)) {
                    File::delete($path);
            }
        $file=$request->file('image');
        $ext=$file->getClientOriginalExtension();
        $filename=time().'.'.$ext;
        $file->move(public_path('assets/uploads/category'), $filename);
        $category->img= $filename;
    }
        $category->name= $request->input('name');
        $category->slug= $request->input('slug');
        $category->description= $request->input('description');
        $category->status= $request->input('status')==true?'1':'0';
        $category->populer= $request->input('popular')==true?'1':'0';
        $category->meta_title= $request->input('meta_title');
        $category->meta_kewwords= $request->input('meta_keywords');
        $category->meta_descrip= $request->input('meta_descrip');
        $category->update();
        return redirect('/dashboard')->with('status','data updated successfully');


    }
        public function deleteCategory($id) {

            $category=Category::find($id);
            if ($category->img)
            {
                $path='assets/uploads/category/'.$category->img;
                if (File::exists($path))
                    {
                        File::delete($path);
                    }
            }
            $category->delete();
            return redirect('category')->with('status','category has deleted');

    }
}
