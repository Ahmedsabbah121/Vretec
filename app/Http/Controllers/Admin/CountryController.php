<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Country;
use App\City;
use Illuminate\Http\Request;
use Validator;
class CountryController extends Controller
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
        $countries = Country::all();
        return view('Admins.countries.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Country $country)
    {
        $country = new Country();
        return view('Admins.countries.create',compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Country $country , Request $request)
    {
            request()->validate([
            'country_code'=>'required|numeric',
            'country_name'=>'required|min:3'
            ]);
            $country = new Country;
            $country->country_code = request('country_code');
            $country->country_name = request('country_name');
            $country->save();
        // $Country = Country::create($this->StoreDataValidation());
        return redirect('/admin/countries');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        $country = Country::where('id',$country->id)->firstOrfail();
        $cities = City::where('country_id',$country->id)->get();
         //dd($country);
        return view('Admins.countries.show', compact('country','cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('Admins.countries.edit',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $rules = [
            'country_name' => 'required|min:3'
        ];
        $validator = Validator::make( request()->all() , $rules);
        if($validator->fails()){
            return back();
        }
        else{
            $country->country_name = request('country_name');
            $country->save();
            return redirect('/admin/countries');
        }
        // $country->update($this->UpdateDataValidation());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }
    public function UpdateDataValidation(){
        return tap(
            request()->validate([
                'country_name'=>'required|min:3'
                ]));
    }
}
