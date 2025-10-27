<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FlightsController extends BaseController
{
    public function flights_airports(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'code' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $flights_airports = DB::table("flights_airports")->where("code", $input['code'])->get();

        if ($flights_airports->isEmpty()) {
            $city_airports = DB::table("flights_airports")->where("city", 'like', '%' . $input['code'] . '%')->get();
            return $this->sendResponse($city_airports, 'successfully.');
        } else {
            return $this->sendResponse($flights_airports, 'successfully.');
        }


    }

}
