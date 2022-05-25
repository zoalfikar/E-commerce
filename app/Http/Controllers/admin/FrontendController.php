<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function  index() {

        return view('admin.index') ;

   }
   public function orderList() {
       $orders=Order::all();
       return view('admin.orders.orders',compact('orders'));

   }
   public function orderDetail($id) {
   $orders=Order::where('id',$id)->first();
   return view('admin.orders.orderDetail', compact('orders'));
   }
   public function updateOrder(Request $request , $id)
   {
    $order=Order::find($id);
    $order->status= $request->input('status');
    $order->update();
    return redirect('/order-list')->with('status',"order updated successfuly");
   }
   public function users() {
    $users=User::all();
    return view('admin.users.users',compact('users'));
    }
    public function userDetails($id) {
        $user=User::find($id);
        return view('admin.users.userDetail',compact('user'));
        }

}
