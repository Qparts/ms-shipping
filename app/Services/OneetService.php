<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class OneetService
{

    public function storeOrder($request){


        $response = Http::withHeaders([
            'Content-Type'=>'application/json',
            'Authorization'=> 'bearer '. 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiMTkzMjg3MGFmMTU0NWYzNWQ3OWZiYTRmYzYzZWFiNzc5NDUyM2QxZDhjYTlhMWIyNjRkNjc2NWU4NjJkNTg2OGJlNDJkZTk1YWU2Mjk5NDgiLCJpYXQiOjE2NzY4ODk2MDkuMjYyMDk5LCJuYmYiOjE2NzY4ODk2MDkuMjYyMTAyLCJleHAiOjE3MDg0MjU2MDkuMDk1MjUsInN1YiI6IjIzMDk4Iiwic2NvcGVzIjpbXX0.pANmPgAfn0xATzkfoX5ulanA0-mkuGIu2E6ohVGK_5IexpQNVM6GDv39bG76clpeh6yOmxLeY538M_eh3Wcr_LRdMoADzoIXw4xMhXHXZ1o1ANMLlMGXzww9U19PREjCr6N6euZmmYPTgEXan6949MsvOtiAEQey6yzvZ6QLXcxLyIqmA42vQkFEDDyGiGSvio41s1__K_Gkd49osbUSRIPaXp03sxWQXmSGmRHNpqV9fY16LU6n0vfjXZASIeLShP92xEA6eoTKNgMx7TboRPqV1IFu-I9mnMzgwogIVzdYI14kBHrggArMIJdVnVCPSf9p7pNeSUq0zDmNpLGHfplyDR7KO65liz8Cj9EUCGY7NpdKXq52984parHGHJpWCLKdO_09GM2YBTre3vc9tCnrGvfrOwYlijaUEFbY60zbMO2Dp0EWRO7RDcpxk3MCo4JSGqETf9MnnSNGzNCCpPLUynj0MSutCs7dvm8YdlWA1lkt196ISe120SJsBajw3mCJcv_VO_WAxiJZC9MMBsILuAzMvDeksW2vlk6YyO0rWjecfs0Yyz8W8Nt9KXOK6Z55CtIjjhXUjaUTn6lFMAqOTSc0D42syE1dAUO-OQJDCqXirdf9yTLD36Y7S5QyGcaUFcCfjfs7H-KDLuohfgN1FlFJ7jlQusgsDqEtg20',
            'X-Requested-With'=>'XMLHttpRequest'
        ])->post(env('Oneet_URL').'/store/orders', [
            'pickup_address_id' => $request->pickup_address_id,
            'store_id' => $request->store_id,
            'vehicle_type_id' => $request->vehicle_type_id,
            'name' => $request->name,
            'mobile_no' => $request->mobile_no
        ]);

        return $response->json();
    }

}
