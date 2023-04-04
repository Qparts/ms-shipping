<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class OneetService
{

    public function storeOrder($request,$token){

        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'Authorization'=> $token,
            'X-Requested-With'=>'XMLHttpRequest'
        ])->post(config('shipping.Oneet_URL').'/store/orders', [
            'name' => $request->name,
            'mobile_no' => $request->phone_number,
            'invoice_total_price'=>$request->order_total,
            'pickup_address_id'=>$request->pickup_address_id,
            'store_id'=>$request->store_id,
            'vehicle_type_id'=>2,
            'dropoff_time'=>'morning',
            'no_of_pieces'=>$request->no_of_box,
            'payment_method'=>$request->payment_method
        ]);

        return $response->json();
    }

    public function trackOrder($request,$token,$id){
        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'Authorization'=> $token,
            'X-Requested-With'=>'XMLHttpRequest'
        ])->get(config('shipping.Oneet_URL').'/store/orders/'.$id, [
            "store_id"=> $request->store_id,
            "order_no"=> $request->order_no
        ]);

        return $response->json();
    }

    public function getAllOrders($request,$token){
        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'Authorization'=> $token,
            'X-Requested-With'=>'XMLHttpRequest'
        ])->get('https://test.one8-app.com/api/v1/store/orders', [
            "store_id"=>$request->store_id
        ]);

        return $response->json();
    }

    public function listOneetAddresses($request,$token){
        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'Authorization'=> $token,
            'X-Requested-With'=>'XMLHttpRequest'
        ])->get(config('shipping.Oneet_URL').'/store/addresses', [
            "store_id"=>$request->store_id
        ]);

        return $response->json();
    }
    public function createOneetAddress($request,$token){
        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'Authorization'=> $token,
            'X-Requested-With'=>'XMLHttpRequest'
        ])->post(config('shipping.Oneet_URL').'/store/addresses', [
            "store_id"=>$request->store_id,
            "address_line1"=>$request->address_line1,
            "latitude"=>$request->latitude,
            "longitude"=>$request->longitude,
            "store_close_time"=>$request->store_close_time,
            "city_id"=>$request->city_id,
            "district_id"=>$request->district_id,
        ]);

        return $response->json();
    }


    public function listOneetCities($token){
        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'Authorization'=> $token,
            'X-Requested-With'=>'XMLHttpRequest'
        ])->get(config('shipping.Oneet_URL').'/cities', []);

        return $response->json();
    }
    public function listOneetDistricts($token){
        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'Authorization'=> $token,
            'X-Requested-With'=>'XMLHttpRequest'
        ])->get(config('shipping.Oneet_URL').'/districts', []);

        return $response->json();
    }
}
