<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use App\Models\Languages as ModelsLanguages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class LanguagesController extends Controller
{
    public function index()
    {
        $lang=Language::all();
        return view('admin.Languages.index',compact('lang'));
    }

    public function addLanguage()
    {
        return view('admin.Languages.addLanguage');
    }
    public function insertLanguage(LanguageRequest $request)
    {
        $language= new Language();
        $language->name=$request->input('name');
        $language->abbe=$request->input('abbe');
        $language->locale=$request->input('locale');
        $language->direction=$request->input('direction');
        $language->active=$request->input('active')==true ? 1 : 0 ;
        $language->save();
        $lang=Language::all();
        return view('admin.Languages.index',compact('lang'))->with('status',"languages added successfully");
    }

    public function editeLanguage(Request $request,$id)
    {
        $edit_language=Language::find($id);
        return view('admin.Languages.addLanguage',compact('edit_language'));
    }

    public function updateLanguage(LanguageRequest $request,$id)
    {

        $edit_language=Language::find($id);
        if ($edit_language)
        {
            $edit_language->name=$request->input('name');
            $edit_language->abbe=$request->input('abbe');
            $edit_language->locale=$request->input('locale');
            $edit_language->direction=$request->input('direction');
            $edit_language->active=$request->input('active')==true ? 1 : 0 ;
            $edit_language->update();
            return redirect('/languages')->with('status',"languages updated successfully");

        }
        else
        {
            return redirect()->back()->with('status',"this languages not exists");
        }

     }

    public function deletLanguage($id)
    {
        $language=Language::find($id);
        $language->delete();
        return redirect('/languages')->with('status',"languages deleted successfully");


    }

    public function changeLanguage(Request $request)

    {
        $lg=$request->input('lang');
        Session::put('local',$lg);
        return response()->json();

    }
}
