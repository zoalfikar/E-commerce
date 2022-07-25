<?php

namespace App\Http\Controllers\payment;

use App\Http\Services\MyFatoorahService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyFatoorahController extends Controller
{
    private $MyfatoorahService ;
    public function __construct(MyFatoorahService $MyfatoorahService)
    {

        $this->MyfatoorahService=$MyfatoorahService;

    }
    public function payOrder()
    {
        $data = [
            'CustomerName'       => 'FName LName',
            'NotificationOption' => 'Lnk',
            'InvoiceValue'       => '10',
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => 'test@test.com',
            'CallBackUrl'        => env('MY_FATOORA_SUCCESS'),
            'ErrorUrl'           => env('MY_FATOORA_ERRORE'),
            'MobileCountryCode'  => '+965',
            'CustomerMobile'     => '12345678',
            'Language'           => 'en',
        ];

        return $this->MyfatoorahService->sendPayment($data);

    }
        /* Get MyFatoorah payment information */
        public function paymentCallback(Request $request) {
            $data = [
                'Key'     => $request->paymentId,
                'KeyType' => 'paymentId'
            ];
            return $this->MyfatoorahService->getPaymentStatus($data);

        }
}
