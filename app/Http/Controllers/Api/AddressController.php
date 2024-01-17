<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
class AddressController extends Controller
{
    public function getCountry()
    {
        $country = Country::get();
        return response()->json($country);
    
    }
    public function getState(Request $request)
    {
        $state = State::where('country_id',$request->country_id)->get();
        return response()->json($state);
    }
    public function getCity(Request $request)
    {
        $city = City::where('state_id',$request->state_id)->get();
        return response()->json($city);
    }
}
