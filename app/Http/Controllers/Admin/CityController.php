<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\City;
use App\Country;
use Illuminate\Http\Request;
use Validator;
class CityController extends Controller
{


    public function __construct(){
        $this->middleware('auth:admin');
        // $this->middleware('guest:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Country $country)
    {

        return view('Admins.countries.create-city',compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , Country $country)
    {
            request()->validate([
                'city_name'=>'required'
                ]);
            $city = new City;
            $city->city_name = request('city_name');
            $city->country_id = $country->id;
            $city->save();
        return redirect('/admin/countries/'.$country->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }

    public function StoreDataValidation(){
        return tap(
            request()->validate([
            'city_name'=>'required|min:3',
            ]));
    }
}
