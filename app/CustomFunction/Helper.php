<?php

use App\Models\Category;
use App\Models\Language;
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

function CategoryPhoto($image ,$request)
{
    $file=$request->file($image);
    $ext=$file->getClientOriginalExtension();
    $filename=time().'.'.$ext;
    $file->move(public_path('assets/uploads/category'), $filename);
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





