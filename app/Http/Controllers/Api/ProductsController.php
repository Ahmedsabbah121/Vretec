<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Products;
use App\SubCategory;
use Illuminate\Http\Request;
use Validator;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //send sub_cat_id to get all products
        //update category_id in products table to sub_cat_id sub_cat_id

        $all_products = array();
        $all_products_cat = array();
        $single_product = (object)[];
        if(empty(request('sub_cat_id'))){
            $products = Products::get();


                for($j = 0 ; $j <count($products) ; $j++){
                    $categories = SubCategory::where('id',$products[$j]->sub_cat_id)->first();
                    $single_product = (object)[
                        'product_id'=> $products[$j]->product_id,
                        'name'=> $products[$j]->name,
                        'price'=> $products[$j]->price,
                        'image'=>'http://www.vretech.com/images/products/'.$products[$j]->image,
                        'available_quantity'=> $products[$j]->available_quantity,
                        'status'=>$products[$j]->status,
                        'sub_cat_id'=>$products[$j]->sub_cat_id,
                        'sub_cat_name'=>$categories->subcategory_name,
                        'sub_cat_image'=>'http://www.vretech.com/images/products/'.$categories->subcategory_image,
                        'owner_id'=>$products[$j]->owner_id,
                        'created_at'=> $products[$j]->created_at,
                        'updated_at'=>$products[$j]->updated_at,
                    ];
                    array_push($all_products, $single_product);

            }

            result(200,'success',$all_products);
        }else{
            $sub_cat_ids = explode(",",request('sub_cat_id'));
            for($i = 0 ; $i < count($sub_cat_ids); $i++){
                $products = Products::where('sub_cat_id',$sub_cat_ids[$i])->get();
                $id = $sub_cat_ids[$i];
                $category_image = SubCategory::find($id);
                for($j = 0 ; $j <count($products) ; $j++){
                    $single_product = (object)[
                        'product_id'=> $products[$j]->product_id,
                        'name'=> $products[$j]->name,
                        'price'=> $products[$j]->price,
                        'image'=>'http://www.vretech.com/images/products/'.$products[$j]->image,
                        'available_quantity'=> $products[$j]->available_quantity,
                        'status'=>$products[$j]->status,
                        'sub_cat_id'=>$products[$j]->sub_cat_id,
                        'sub_cat_name'=>$category_image->subcategory_name,
                        'sub_cat_image'=>'http://www.vretech.com/images/products/'.$category_image->subcategory_image,
                        'owner_id'=>$products[$j]->owner_id,
                        'created_at'=> $products[$j]->created_at,
                        'updated_at'=>$products[$j]->updated_at,
                    ];
                    array_push($all_products, $single_product);
                }
            }
            result(200,'success',$all_products);
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
     * @param  \App\ProductDetails  $productDetails
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        $rules =[
            'product_id' =>'required|numeric',
        ];
        $validator = Validator::make(request()->all() , $rules);
        if($validator->fails()){
            falseResult(401,'Validation Error please check your input');
        }
        else{
            $product_details =  Products::where('product_id',Request('product_id'))->first();
            if($product_details){
                $product_details->image = 'http://www.vretech.com/images/products/'.$product_details->image;
                trueresult(200,'Success request',$product_details);
            }
            else{
                falseResult(401,'No Data hes been found');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductDetails  $productDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductDetails $productDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductDetails  $productDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductDetails $productDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductDetails  $productDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDetails $productDetails)
    {
        //
    }
}
