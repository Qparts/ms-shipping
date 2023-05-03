<?php


namespace App\Services;
use App\Http\Resources\AddressResource;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use http\Client\Response;
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
            "weight"=>$request->weight,
            "latitude"=>$request->latitude,
            "longitude"=>$request->longitude,
        );

        $client = new Client(['base_uri' => config('shipping.Torod_URL'),'headers' => $headers] );

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
        $url = config('shipping.Torod_URL'). '/get-all/countries';
        $headers = [
            'Authorization' => request()->bearerToken()
        ];
        // Send Request
        $response =  Http::acceptJson()->withHeaders($headers)->get($url);
        return $response->json();
        }
    public function  regions($country_id = null){

        $url = config('shipping.Torod_URL'). '/get-all/regions';
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
        $url = config('shipping.Torod_URL'). '/get-all/cities';
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
            "warehouse_name"=>$request['warehouse_name'],
            "warehouse"=>$request['warehouse'],
            "contact_name"=>$request['contact_name'],
            "phone_number"=>$request['phone_number'],
            "email"=>$request['email'],
            "zip_code"=>$request['zip_code'],
            "type"=>$request['type'],
            "locate_address"=>$request['locate_address'] ?? NULL,
            "latitude"=>$request['latitude'] ?? NULL,
            "longitude"=>$request['longitude'] ?? NULL,

        );

        $client = new Client(['base_uri' => config('shipping.Torod_URL'),'headers' => $headers] );
        try {
            $response = $client->request('POST', '/en/api/create/address' ,
                ['form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }

        $responseJSON = json_decode($response->getBody(), true);
        return  new AddressResource($responseJSON['data']);
    }

    public function listAddress(){
        $url = config('shipping.Torod_URL'). '/address/list';
        $headers = [
            'Authorization' => request()->bearerToken()
        ];
        // Send Request
        $response =  Http::acceptJson()->withHeaders($headers)->get($url);
        return $response->json();
    }

    public function orderList(){
        $url = config('shipping.Torod_URL'). '/order/list';
        $headers = [
            'Authorization' => request()->bearerToken()
        ];
        // Send Request
        $response =  Http::acceptJson()->withHeaders($headers)->get($url);
        return $response->json();
    }

    public function getCourierPartners(){
        $url = config('shipping.Torod_URL'). '/get-all/courier/partners';
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

        $client = new Client(['base_uri' => config('shipping.Torod_URL'),'headers' => $headers] );
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

        $client = new Client(['base_uri' => config('shipping.Torod_URL'),'headers' => $headers] );
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
            "warehouse_name"=>$request->warehouse_name,
            "warehouse"=>$request->warehouse,
            "contact_name"=>$request->contact_name,
            "phone_number"=>$request->phone_number,
            "email"=>$request->email,
            "zip_code"=>$request->zip_code,
            "type"=>$request->type,
            "locate_address"=>$request->locate_address,
            "latitude"=>$request->latitude,
            "longitude"=>$request->longitude
        );
        $client = new Client(['base_uri' => config('shipping.Torod_URL'),'headers' => $headers] );
        try {
            $response = $client->request('POST', '/en/api/update/address/'.$address_id ,
                [      'form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }

        $responseJSON = json_decode($response->getBody(), true);

        if(!$responseJSON){
            return response()->json(['message' => 'something went wrong!']);
        }
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

        $client = new Client(['base_uri' => config('shipping.Torod_URL'),'headers' => $headers] );
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
        $url = config('shipping.Torod_URL'). '/shipments/list';
        $headers = [
            'Authorization' => request()->bearerToken()
        ];
        // Send Request
        $response =  Http::acceptJson()->withHeaders($headers)->get($url);
        return $response->json();
    }
    public function trackOrder($request){
        $headers = [
            'Accept'=>'application/json',
            'Authorization'=>request()->bearerToken(),
            'Content-Type'=>'application/json'
        ];
        // Set Data Body
        $body = array(
            "tracking_id"=>$request->tracking_id
        );

        $client = new Client(['base_uri' => config('shipping.Torod_URL'),'headers' => $headers] );
        try {
            $response = $client->request('POST', '/en/api/order/track' ,
                [      'form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }

        $responseJSON = json_decode($response->getBody(), true);
        return $responseJSON;
    }

    public function cancelOrder($request){
        $headers = [
            'Accept'=>'application/json',
            'Authorization'=>request()->bearerToken(),
            'Content-Type'=>'application/json'
        ];
        // Set Data Body
        $body = array(
            "tracking_id"=>$request->tracking_id
        );

        $client = new Client(['base_uri' => config('shipping.Torod_URL'),'headers' => $headers] );
        try {
            $response = $client->request('POST', '/en/api/order/track' ,
                [      'form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }

        $responseJSON = json_decode($response->getBody(), true);
        return $responseJSON;
    }

    public function CourierList($request){
        $headers = [
            'Accept'=>'application/json',
            'Authorization'=>request()->bearerToken(),
            'Content-Type'=>'application/json'
        ];
        // Set Data Body
        $body = array(
            "warehouse"=>$request->warehouse,
            "customer_city_id"=>$request->customer_city_id,
            "payment"=>$request->payment,
            "weight"=>$request->weight,
            "order_total"=>$request->order_total,
            "no_of_box"=>$request->no_of_box,
            "type"=>$request->type,
            "filter_by"=>"fastest"
            //is_insurance:1
        );
        $client = new Client(['base_uri' => config('shipping.Torod_URL'),'headers' => $headers] );
        try {
            $response = $client->request('POST', '/en/api/courier/partners/list',
                [      'form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }

        $responseJSON = json_decode($response->getBody(), true);
        if(!$responseJSON['data'][1]){
            return response()->json(['message' => 'something went wrong!']);
        }
        return $responseJSON['data'];

    }

    public function getLatLongDetails($request){
        $headers = [
            'Accept'=>'application/json',
            'Authorization'=>request()->bearerToken(),
            'Content-Type'=>'application/json'
        ];
        // Set Data Body
        $body = array(
            "latitude"=>$request->latitude,
            "longitude"=>$request->longitude
        );

        $client = new Client(['base_uri' => config('shipping.Torod_URL'),'headers' => $headers] );
        try {
            $response = $client->request('POST', '/en/api/get-latlong-details' ,
                [      'form_params' =>  $body ] );
        }catch (BadResponseException $e){
            return  $e->getMessage();
        }

        $responseJSON = json_decode($response->getBody(), true);
        return $responseJSON['data']['city_data'];
    }
}
