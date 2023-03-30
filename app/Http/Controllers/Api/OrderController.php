<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OneetService;
use App\Services\TorodService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponse;
    public $torodService;
    public $oneetService;
    public function __construct(TorodService $torodService,OneetService $oneetService)
    {
        $this->torodService = $torodService;
        $this->oneetService = $oneetService;
    }
//    public function store(Request $request,$order_type){
//
//        $rules = [
//            "name"=>"required",
//            "phone_number"=>"required",
//            'email'=>'required|email',
//            'item_description'=>'required',
//            'order_total'=>'required',
//            'payment'=>'required',
//            'weight'=>'required',
//            'no_of_box'=>'required',
//            'type'=>'required'
//        ];
//
//        $validator = \Validator::make($request->all(), $rules);
//        $token = $request->header('Authorization');
//        if($validator->fails())
//        {
//            $messages = $validator->getMessageBag();
//            return $this->error($messages,409);
//        }
//
//        if($order_type == "Oneet"){
//            return $this->createOneetOrder($request);
//        }else{
//            return $this->createTorodOrder($request,$token);
//
//        }
//    }

    //Oneet
    public function storeOneet(Request $request){
        // Oneet rules
        $OneetRules = [
            'pickup_address_id' => 'required|integer',
            'store_id' => 'required|integer',
            'vehicle_type_id' => 'required|integer',
            'name' => 'required',
            'phone_number' => 'required'
        ];

        $validator = \Validator::make($request->all(), $OneetRules);
        $token = $request->header('Authorization');
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return $this->error($messages,409);
        }
        return $this->oneetService->storeOrder($request,$token);
    }
    public function trackOrderOneet(Request $request,$id){
        $token = $request->header('Authorization');
        return $this->oneetService->trackOrder($request,$token,$id);
    }

    //Torod
     public function createTorodOrder(Request $request){
        $torodService = new TorodService();
        $token = $request->header('Authorization');
        $res = $torodService->storeOrder($request,$token);
        return $this->success($res,"success");
    }
     public function  orderList(){
        return $this->torodService->orderList();
     }
     public function orderShipProcess(Request $request){
         return $this->torodService->orderShipProcess($request);
     }


}
