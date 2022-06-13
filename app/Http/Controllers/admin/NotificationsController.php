<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function activeStore(Request $req)
    {

    $store=Store::where('slug',$req->slug)->first();
    $store->active=1;
    $store->update();
    return response()->json(['status'=>"store is active now"]);

    }
    public function deletStore(Request $req)
    {
        $store=Store::where('slug',$req->slug)->first();
        $store->delete();
        return response()->json(['status'=>"store has been removed"]);

    }
}
