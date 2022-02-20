<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApartmentResource;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $requestQuery = $request->query();
        $reqServices = explode(',', $request->services);
        // ddd($requestQuery['address']);
        // ddd($reqServices);

        function calcDist($lat1, $lon1, $lat2, $lon2)
        {
            $distance = (3958 * 3.1415926 * sqrt(($lat2 - $lat1) * ($lat2 - $lat1) + cos($lat2 / 57.29578) * cos($lat1 / 57.29578) * ($lon2 - $lon1) * ($lon2 - $lon1)) / 180);
            return $distance * 1.852; //Converto miglia in chilometri
        };

        // $testDistance = calcDist(45.06837000, 7.68307000, 45.46362000, 9.18812000);
        // ddd($testDistance);

        $aparts = Apartment::where('n_bathroom', '>', $requestQuery['n_bathroom'])
            ->where('n_rooms', '>', $requestQuery['n_rooms'])
            ->get();

        if (!empty($request->services)) {
            $aparts = Apartment::whereHas('services', function ($param) use ($reqServices) {
                $param->whereIn('service_id', $reqServices);
            })->get();
        }

        return ApartmentResource::collection($aparts);

        //return ApartmentResource::collection(Apartment::with(['services'])->paginate(20));
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        //
        return new ApartmentResource(Apartment::find($apartment->id));
    }
}