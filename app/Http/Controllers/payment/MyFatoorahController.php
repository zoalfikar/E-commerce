<?php

namespace App\Http\Controllers\payment;

use App\Http\Services\MyFatoorahService;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class MyFatoorahController extends Controller
{
    private $MyfatoorahService ;
    public function __construct(MyFatoorahService $MyfatoorahService)
    {
        $this->MyfatoorahService=$MyfatoorahService;
    }
    public function payOrder(Request $req)
    {
        $order_data = $req->all();
        Cache::rememberForever('myFatoora'.Auth::id() , $order_data );
        $products = productsFromStore($req->store_id);

        $total_price = 0 ;
        foreach ($products as  $product) {
            $total_price += (double)$product->selling_price * (int)$product->qty ;
        }
        if ($req->store_id==0)
        {
            $key=env('MY_FATOORA_AUTHORIZATION');
        }
        else
        {
            $key = Store::select('myfatoora_key')->where('id', $req->store_id)->first();
            $key =Crypt::decrypt($key);
        }


        $data = [
            'CustomerName'       => $req->firstname." ". $req->lastname,
            'NotificationOption' => 'Lnk',
            'InvoiceValue'       => $total_price,
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => $req->email,
            'CallBackUrl'        => env('MY_FATOORA_SUCCESS'),
            'ErrorUrl'           => env('MY_FATOORA_ERRORE'),
            'MobileCountryCode'  => '+965',
            'CustomerMobile'     => $req->phoneNumber,
            'Language'           => 'en',
        ];

        return $this->MyfatoorahService->sendPayment($data,$key);

    }
        /* Get MyFatoorah payment information */
        public function paymentCallback(Request $request)
        {

        $order_data = Cache::pull('myFatoora'.Auth::id());
        $total=0;
        $order=new Order();
        $order->user_id=Auth::id();
        $order->fname=$order_data->firstname;
        $order->lname=$order_data->lastname;
        $order->email=$order_data->email;
        $order->phone=$order_data->phonenumber;
        $order->address1=$order_data->address1;
        $order->address2=$order_data->address2;
        $order->city=$order_data->city;
        $order->state=$order_data->state;
        $order->country=$order_data->country;
        $order->pincode=$order_data->pincod;
        $order->payment_mode="my fatoora";
        $order->payment_id=$order_data->payment_id;
        $order->store_id=$order_data->store_id ;
        $cartitems_total =productsFromStore($request->store_id);
        foreach ($cartitems_total as $item)
        {
            $total+=$item->prod_qty*(float)$item->Product->selling_price;
        }
        $order->total_price=$total;
        $order->save();

            if ($order_data->store_id==0)
            {
                $key=env('MY_FATOORA_AUTHORIZATION');
            }
            else
            {
                $key = Store::select('myfatoora_key')->where('id', $order_data->store_id)->first();
                $key =Crypt::decrypt($key);
            }
            $data = [
                'Key'     => $request->paymentId,
                'KeyType' => 'paymentId'
            ];
            return $this->MyfatoorahService->getPaymentStatus($data,$key);

        }
}
