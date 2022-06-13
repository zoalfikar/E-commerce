<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use App\Notifications\StoreCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $store->save();
        //sent notification to admins
        $users=User::where("role_as" , "1")->get();
        Notification::send($users, new StoreCreated($store->slug,$store->ownerName));
        return redirect('/stores')->with('status','store create successfully');
    }

    public function storeDetails($slug)
    {
        $store=Store::where('slug',$slug)->first();
        return view('frontend.stores.SFrontend.storeDetails',compact('store'));
    }
    public function showCP()
    {
        return view('frontend.stores.SControlPanel.index');

    }
}
