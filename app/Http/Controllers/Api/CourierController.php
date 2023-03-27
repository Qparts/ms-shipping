<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TorodService;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public $torodService;
    public function __construct(TorodService $torodService)
    {
        $this->torodService = $torodService;
    }

    public function getCourierPartners(){
        return $this->torodService->getCourierPartners();
    }

    public function orderCourierPartner(Request $request){
        return $this->torodService->orderCourierPartner($request);
    }
    public function CourierList(Request $request){
        return $this->torodService->CourierList($request);
    }
}
