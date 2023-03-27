<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TorodService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use ApiResponse;
    public $torodService;
    public function __construct(TorodService $torodService)
    {
        $this->torodService = $torodService;
    }

    public function countries(){
        return $this->torodService->countries();
    }
    public function regions($country_id){
        return $this->torodService->regions($country_id);
    }
    public function cities($region_id){
        return $this->torodService->cities($region_id);
    }
    public function createAddress(Request $request){
        $addresses = $request->addresses;
      //  $addressesCreated = [];
        foreach($addresses as $address){
            $addressCreated =    $this->torodService->createAddress($address);
          //  array_push($addressCreated,$addressCreated);
        }
        return $addressCreated;
    }
    public function listAddress(){
        return $this->torodService->listAddress();
    }
    public function details(Request $request){
        return $this->torodService->details($request);
    }
    public function updateAddress(Request $request,$address_id){
        return $this->torodService->updateAddress($request,$address_id);
    }

}
