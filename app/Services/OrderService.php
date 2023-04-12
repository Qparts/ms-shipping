<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class OrderService
{
    public function getOrderStatus($request){
        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'X-Requested-With'=>'XMLHttpRequest'
        ])->post(config('shipping.Order_URL').'/purchase_orders/update-torod-shipment-status', [
            "order_id"=>$request->order_id,
            "tracking_id"=>$request->tracking_id,
            "status"=>$request->status,
            "description"=>$request->description,
            "torod_description"=>$request->torod_description,
            "torod_description_ar"=>$request->torod_description_ar
        ]);

        return $response->json();
    }
}
