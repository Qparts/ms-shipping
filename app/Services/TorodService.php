<?php


namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Http;

class TorodService
{

    public function storeOrder($request,$token){
        $headers = [
            'Accept'=>'application/json',
            'Authorization'=>$token,
            'Content-Type'=>'application/json'
        ];
        // Set Data Body
        $body = array(
            "district_id" => $request->district_id,
            "name" => $request->name,
            "email" => $request->email,
            "phone_number" => $request->phone_number,
            "item_description"=> $request->item_description,
            "order_total" => $request->order_total,
            "payment"=>$request->payment,
            "no_of_box"=>$request->no_of_box,
            "type"=>$request->type,
            "locate_address"=>$request->locate_address,
            "weight"=>$request->weight
        );

        $client = new Client(['base_uri' => env('Torod_URL'),'headers' => $headers] );

        try {
            $response = $client->request('POST', '/en/api/order/create' ,
                [      'form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }

        $responseJSON = json_decode($response->getBody(), true);
        return $responseJSON;

    }

    public function countries(){
        $url = env('Torod_URL'). '/get-all/countries';
        $headers = [
            'Authorization' => request()->bearerToken()
        ];
        // Send Request
        $response =  Http::acceptJson()->withHeaders($headers)->get($url);
        return $response->json();
        }
    public function  regions($country_id = null){

        $url = env('Torod_URL'). '/get-all/regions';
        if($country_id){
            $url = $url . "?country_id=".$country_id;
        }

        $headers = [
            'Authorization' => request()->bearerToken()
        ];
        // Send Request
        $response =  Http::acceptJson()->withHeaders($headers)->get($url);
        return $response->json();
    }

    public function  cities($region_id = null){
        $url = env('Torod_URL'). '/get-all/cities';
        if($region_id){
            $url = $url . "?region_id=".$region_id;
        }
        $headers = [
            'Authorization' => request()->bearerToken()
        ];
        // Send Request
        $response =  Http::acceptJson()->withHeaders($headers)->get($url);
        return $response->json();
    }

    public function createAddress($request){

        $headers = [
            'Accept'=>'application/json',
            'Authorization'=>request()->bearerToken(),
            'Content-Type'=>'application/json'
        ];
        // Set Data Body
        $body = array(
            "warehouse_name"=>$request->warehouse_name,
            "warehouse"=>$request->warehouse,
            "contact_name"=>$request->contact_name,
            "phone_number"=>$request->phone_number,
            "email"=>$request->email,
            "zip_code"=>$request->zip_code,
            "type"=>$request->type,
            "locate_address"=>$request->locate_address

        );

        $client = new Client(['base_uri' => env('Torod_URL'),'headers' => $headers] );
        try {
            $response = $client->request('POST', '/en/api/create/address' ,
                [      'form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }

        $responseJSON = json_decode($response->getBody(), true);
        return $responseJSON;
    }

    public function listAddress(){
        $url = env('Torod_URL'). '/address/list';
        $headers = [
            'Authorization' => request()->bearerToken()
        ];
        // Send Request
        $response =  Http::acceptJson()->withHeaders($headers)->get($url);
        return $response->json();
    }

    public function orderList(){
        $url = env('Torod_URL'). '/order/list';
        $headers = [
            'Authorization' => request()->bearerToken()
        ];
        // Send Request
        $response =  Http::acceptJson()->withHeaders($headers)->get($url);
        return $response->json();
    }

    public function getCourierPartners(){
        $url = env('Torod_URL'). '/get-all/courier/partners';
        $headers = [
            'Authorization' => request()->bearerToken()
        ];
        // Send Request
        $response =  Http::acceptJson()->withHeaders($headers)->get($url);
        return $response->json();
    }

    public function orderCourierPartner($request){
        $headers = [
            'Accept'=>'application/json',
            'Authorization'=>request()->bearerToken(),
            'Content-Type'=>'application/json'
        ];
        // Set Data Body
        $body = array(
            "order_id"=>$request->order_id,
            "warehouse"=>$request->warehouse,
            "type"=>$request->type,
            "filter_by"=>$request->filter_by,
            "is_insurance"=>$request->is_insurance

        );

        $client = new Client(['base_uri' => env('Torod_URL'),'headers' => $headers] );
        try {
            $response = $client->request('POST', '/en/api/courier/partners' ,
                [      'form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }

        $responseJSON = json_decode($response->getBody(), true);
        return $responseJSON;
    }
    public function details($request){
        $headers = [
            'Accept'=>'application/json',
            'Authorization'=>request()->bearerToken(),
            'Content-Type'=>'application/json'
        ];
        // Set Data Body
        $body = array(
            "address"=>$request->address
        );

        $client = new Client(['base_uri' => env('Torod_URL'),'headers' => $headers] );
        try {
            $response = $client->request('POST', '/en/api/get-address-details' ,
                [      'form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }
        $responseJSON = json_decode($response->getBody(), true);
        return $responseJSON;
    }

    public function updateAddress($request,$address_id){
        $headers = [
            'Accept'=>'application/json',
            'Authorization'=>request()->bearerToken(),
            'Content-Type'=>'application/json'
        ];
        // Set Data Body
        $body = array(
            "order_id"=>$request->order_id,
            "warehouse"=>$request->warehouse,
            "type"=>$request->type,
            "filter_by"=>$request->filter_by,
            "is_insurance"=>$request->is_insurance
        );
        $client = new Client(['base_uri' => env('Torod_URL'),'headers' => $headers] );
        try {
            $response = $client->request('POST', '/en/api/update/address/'.$address_id ,
                [      'form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }

        $responseJSON = json_decode($response->getBody(), true);
        return $responseJSON;
    }
    public function orderShipProcess($request){
        $headers = [
            'Accept'=>'application/json',
            'Authorization'=>request()->bearerToken(),
            'Content-Type'=>'application/json'
        ];
        // Set Data Body
        $body = array(
            "order_id"=>$request->order_id,
            "warehouse"=>$request->warehouse,
            "type"=>$request->type,
            "courier_partner_id"=>$request->courier_partner_id
        );

        $client = new Client(['base_uri' => env('Torod_URL'),'headers' => $headers] );
        try {
            $response = $client->request('POST', '/en/api/order/ship/process' ,
                [      'form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }

        $responseJSON = json_decode($response->getBody(), true);
        return $responseJSON;
    }
    public function shipmentList(){
        $url = env('Torod_URL'). '/shipments/list';
        $headers = [
            'Authorization' => request()->bearerToken()
        ];
        // Send Request
        $response =  Http::acceptJson()->withHeaders($headers)->get($url);
        return $response->json();
    }
}
