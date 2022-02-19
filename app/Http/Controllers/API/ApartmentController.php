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

        $aparts = Apartment::where('address', 'like', '%' . $requestQuery['address'] . '%')
            ->where('n_rooms', '>=', $requestQuery['n_rooms'] ?? 0)
            ->where('n_bathroom', '>=', $requestQuery['n_bathroom'] ?? 0)
            ->get();

        if ($request->services) {
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