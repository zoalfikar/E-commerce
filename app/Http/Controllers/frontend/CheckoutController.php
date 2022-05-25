<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index ()
    {
        $old_iteamCard=Cart::where('user_id',Auth::id())->get();
        foreach ($old_iteamCard as $item)
        {
          if (!Product::where('id',$item->prod_id)->where('qty','>=',$item->prod_qty)->exists())
           {
            $removeitem= Cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();
              $removeitem->delete();
          }
        }
        $iteamCard=Cart::where('user_id',Auth::id())->get();
        return view('frontend.checkout',compact('iteamCard'));
    }
    public function placeholder (Request $request)
    {
        $total=0;
        $order=new Order();
        $order->user_id=Auth::id();
        $order->fname=$request->input('firstname');
        $order->lname=$request->input('lastname');
        $order->email=$request->input('email');
        $order->phone=$request->input('phonenumber');
        $order->address1=$request->input('address1');
        $order->address2=$request->input('address2');
        $order->city=$request->input('city');
        $order->state=$request->input('state');
        $order->country=$request->input('country');
        $order->pincode=$request->input('pincod');
        $order->payment_mode=$request->input('payment_mode');
        $order->payment_id=$request->input('payment_id');
        $order->tracking_no='Ecomerce'.rand(1111,9999);
        $cartitems_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems_total as $item)
        {
            $total+=$item->prod_qty*(float)$item->Product->selling_price;
        }

        $order->total_price=$total;
        $order->save();

        $cartitem = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitem as $item)
        {

            OrderItem::create(
                [
                    'order_id'=>$order->id,
                    'prod_id'=> $item->prod_id,
                    'prod_qty'=>$item->prod_qty,
                    'price'=>$item->Product->selling_price,
                ]
            );
            $prod=Product::where('id',$item->Product->id)->first();
            $prod->qty=$prod->qty - $item->prod_qty ;
            $prod->update();
        }



        if (Auth::user()->address == null)

        {
            $user=User::where('id',Auth::id())->first();
            $user->last_name=$request->input('lastname');
            $user->phone_number=$request->input('phonenumber');
            $user->address1=$request->input('address1');
            $user->address2=$request->input('address2');
            $user->city=$request->input('city');
            $user->state=$request->input('state');
            $user->country=$request->input('country');
            $user->pin_code=$request->input('pincod');
            $user->update();
        }
        $cart = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cart);
        if ($request->input('payment_mode')=="pay by razorpay") {
            return response()->json(['status'=>'order replaced successfully']);
        }
        return redirect('/')->with('status','order replaced successfully');
    }
    public function razorpay(Request $request)
    {
        $cartitems=Cart::where('user_id',Auth::id())->get();
        $total_price=0;
        foreach ($cartitems as $cartitem)
        {
            $total_price+=(float)$cartitem->Product->selling_price*$cartitem->prod_qty;
        }

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phoneNumber = $request->input('phoneNumber');
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $pincod = $request->input('pincod');

        return response()->json([
            'firstname'=>$firstname,
            'lastname'=>$lastname,
            'email'=>$email,
            'phoneNumber'=>$phoneNumber,
            'address1'=>$address1,
            'address2'=>$address2,
            'city'=>$city,
            'state'=>$state,
            'country'=>$country,
            'pincod'=>$pincod,
            'total_price'=>$total_price
        ]);



    }
}
