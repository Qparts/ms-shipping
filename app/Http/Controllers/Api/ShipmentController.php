<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\TorodService;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{

    public $torodService;
    public $orderService;
    public function __construct(TorodService $torodService,OrderService $orderService)
    {
        $this->torodService = $torodService;
        $this->orderService = $orderService;
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
        return $this->orderService->getOrderStatus($request);
    }
}
