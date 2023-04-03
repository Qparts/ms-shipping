<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OneetService;
use App\Services\TorodService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use ApiResponse;
    public $torodService;
    public $oneetService;
    public function __construct(TorodService $torodService,OneetService $oneetService)
    {
        $this->torodService = $torodService;
        $this->oneetService = $oneetService;
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
        $addressesCreated = [];
        foreach($addresses as $address){
            $addressCreated =    $this->torodService->createAddress($address);
            array_push($addressesCreated,$addressCreated);
        }
        return $addressesCreated;
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
    public function getLatLongDetails(Request $request){
        return $this->torodService->getLatLongDetails($request);
    }

    public function listOneetAddresses(Request $request){
        $token = $request->header('Authorization');
        return $this->oneetService->listOneetAddresses($request,$token);
    }

}
