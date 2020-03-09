<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;
use App\SubCategory;
use Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =  Category::all();
        $categories_count = count($categories);
        if($categories_count >0){
            for($i=0 ; $i < count($categories) ; $i++){
                $categories[$i]->category_image = 'http://www.vretech.com/images/categories/'.$categories[$i]->category_image;
            }
                trueresult(200,'Success request',$categories);
        }
        else{
            falseResult(401,'No Data hes been found');
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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $rules = [
            'category_id'=>'required|numeric'
        ];
        $validator  = Validator::make(Request()->all(),$rules );
        if($validator->fails()){
            result( 401, $validator->messages(), null);
        }
        else{
            $category_exist = Category::where('id',request('category_id'))->first();
            if(!empty($category_exist)){
                $Sub_cats = SubCategory::where('category_id',request('category_id'))->get();
                if(count($Sub_cats) > 0){
                    for($i=0 ; $i < count($Sub_cats) ; $i++){
                        $Sub_cats[$i]->subcategory_image = 'http://www.vretech.com/images/sub-categories/'.$Sub_cats[$i]->subcategory_image;
                    }
                    result(200 ,null,$Sub_cats);
                }else{
                    result(401,'No Data Found for this category');
                }
            }else{
                result(401, 'Category Not Found');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
