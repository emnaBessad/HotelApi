<?php

namespace App\Http\Controllers\Api;

use App\Accommodation;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccommodationStoreRequest;
use App\Http\Requests\AccommodationUpdateRequest;
use App\Services\BookingService;
use App\Services\FilterService;
use App\Services\LocationService;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * book for an accommodation.
     *
     * @return JSON
     */
    public function booking(BookingService $bookingService ,$id){
        $accommodation=Accommodation::find($id);
        if(!$accommodation)
            return response()->json(['message'=>'Not Found Data','errors'=>['Accommodation'=>'Not Found Accommodation']],404);
        if($bookingService->changeAvailability($accommodation)==true)
            return response()->json(['message'=>'Succeeded booking operation'], 200);
        else
            return response()->json(['message'=>'Unavailable Accommodation','errors'=>['Accommodation'=>'Accommodation not available']],401);
    }

    /**
     * Display a listing of the accommodation.
     *
     * @return JSON
     */
    public function index(Request $request,FilterService $filterService)
    {
        // In case of thousand accommodations :
        // breaks the collection into multiple collections of 4 to get listed accomodations

        $accommodations=Accommodation::with('location');

        $accommodations=$filterService->filter($accommodations,$request->input());

        return $accommodations->get()->chunk(4);
    }

    /**
     * Store a newly created accommodation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JSON
     */
    public function store(AccommodationStoreRequest $request)
    {
        $location = $this->locationService->storeLocation($request->only(['city','state','country','zip_code','address']));
        $accommodation = Accommodation::create([
            'name'=> $request->name,
            'rating'=> $request->rating,
            'category' => $request->category,
            'location_id' => $location->id,
            'image'=> $request->image,
            'reputation' => $request->reputation,
            'price'=> $request->price,
            'availability'=> $request->availability,
        ]);
        $accommodation->location;
        return response()->json($accommodation, 201);
    }

    /**
     * Display the specified accommodation.
     *
     * @param  int  $id
     * @return JSON
     */
    public function show($id)
    {
        $accommodation=Accommodation::find($id);
        if($accommodation)
            return $accommodation;
        return response()->json(['message'=>'Not Found Data','errors'=>['Accommodation'=>'Not Found Accommodation']],404);
    }

    /**
     * Update the specified accommodation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JSON
     */
    public function update(AccommodationUpdateRequest $request,$id)
    {
        $accommodation=Accommodation::find($id);
        if(!$accommodation)
            return response()->json(['message'=>'Not Found Data','errors'=>['Accommodation'=>'Not Found Accommodation']],404);
        $accommodation->location->update($request->only(['city','state','country','zip_code','address']));
        $accommodation->update($request->only('name','rating','category','location_id','image','reputation','price','availability'));
        return response()->json($accommodation);
    }

    /**
     * Remove the specified accommodation from storage.
     *
     * @param  int  $id
     * @return JSON
     */
    public function destroy($id)
    {
        $accommodation=Accommodation::find($id);
        if(!$accommodation)
            return response()->json(['message'=>'Not Found Data','errors'=>['Accommodation'=>'Not Found Accommodation']],404);
        $accommodation->delete();
        return response()->json(['message'=>'Accommodation has been deleted'], 200);
    }
}
