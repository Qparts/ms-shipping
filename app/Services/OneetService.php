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
        ])->post(env('Oneet_URL').'/store/orders', [
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

    public function trackOrder($request,$token){

    }
}
