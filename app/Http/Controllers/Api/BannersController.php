<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Banners;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners =  Banners::all();
        $bannersCount = count($banners);
            if($bannersCount >0){
                for($i=0 ; $i < $bannersCount ; $i++){
                    $banners[$i]->banner_image = 'http://www.vretech.com/images/banner/'.$banners[$i]->banner_image;
                }
                trueresult(200,"Success request",$banners);
            }
            else{
                falseresult(401,'Sorry No data has been found');
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function show(Banners $banners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function edit(Banners $banners)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banners $banners)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banners  $banners
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banners $banners)
    {
        //
    }
}
