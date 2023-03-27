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
    public function __construct(TorodService $torodService)
    {
        $this->torodService = $torodService;
    }
    public function store(Request $request,$order_type){

        // Oneet rules
//        $OneetRules = [
//            'pickup_address_id' => 'required|integer',
//            'store_id' => 'required|integer',
//            'vehicle_type_id' => 'required|integer',
//            'name' => 'required',
//            'mobile_no' => 'required'
//        ];

        $rules = [
            "name"=>"required",
            "phone_number"=>"required",
            'email'=>'required|email',
            'item_description'=>'required',
            'order_total'=>'required',
            'payment'=>'required',
            'weight'=>'required',
            'no_of_box'=>'required',
            'type'=>'required',
            'district_id'=>'required',
            'locate_address'=>'required'
        ];

        $validator = \Validator::make($request->all(), $rules);
        $token = $request->header('Authorization');
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return $this->error($messages,409);
        }

        if($order_type == "Oneet"){
            return $this->createOneetOrder($request);
        }else{
            return $this->createTorodOrder($request,$token);

        }
    }

    function createOneetOrder($request){

        $oneetService = new OneetService();
        $res = $oneetService->storeOrder($request);
        return $this->success($res,"success");
    }

    function createTorodOrder($request,$token){
        $request->header('Authorization');
        $torodService = new TorodService();

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
