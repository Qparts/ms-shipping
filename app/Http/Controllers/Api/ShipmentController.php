<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TorodService;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{

    public $torodService;
    public function __construct(TorodService $torodService)
    {
        $this->torodService = $torodService;
    }
    public function shipmentList(){
        return $this->torodService->shipmentList();
    }
    public function trackOrder(Request $request){
        return $this->torodService->trackOrder($request);

    }
    public function cancelOrder(Request $request){
        return $this->torodService->cancelOrder($request);

    }
    public function getOrderStatus(Request $request){

    }
}
