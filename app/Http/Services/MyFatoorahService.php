<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class MyFatoorahService
{

    private $base_url;
    private $headers;
    private $request_client;

    public function __construct(Client $request_client) {
        $this->request_client = $request_client;
        $this->base_url = env('FATOORA_BASE_URL');
        $this->headers = [
            'Content-type'=>'application/json',
            'authorization'=>'Bearer '. env('MY_FATOORA_AUTHORIZATION')
        ];

    }

    private function buildRequest($url , $method, $data=[])
    {
        $request= new Request($method,$this->base_url . $url , $this->headers);
        if (!$data)
        {
            return false;
         }
            $response = $this->request_client->send($request,[
                'json'=>$data
            ]);

            if ($response->getStatusCode() != 200) {
                return false;
            }
            $response = json_decode($response->getBody(),true);
            return $response;


    }
    public function sendPayment($data)
    {

     return  $response = $this->buildRequest("v2/SendPayment","POST",$data) ;

    }

    public function getPaymentStatus($data )
    {
        return  $response = $this->buildRequest("v2/getPaymentStatus","POST",$data) ;
    }

}
