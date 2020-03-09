<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Products;
use App\SubCategory;
use App\Category;
use Illuminate\Http\Request;
use Validator;
class ProductsController extends Controller
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
    public function index(Request $request, Category $category )
    {

        $categories = Category::all();
        $products = Products::all();
        return view('Admins.Products.index',compact('products','categories'));

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
    public function show($product)
    {
        $id = (int)$product;
        $product = Products::where('product_id',$id)->first();
        // dd($product);
        return view('Admins.Products.product_details',compact('product'));
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
    public function filter(Request $request)
    {
        // dd(request('category'));
        $products = array();
        $cat_id = Category::where('category_name',request('category'))->first();
        $sub_cats = SubCategory::where('category_id',$cat_id['id'])->get();

        for($i = 0 ; $i < count($sub_cats) ; $i++){
            $items = Products::where('sub_cat_id' , $sub_cats[$i]->id)->get();
            $products = array_push($products,$items);
        }
        $categories = Category::all();
            return view('Admins.Products.index',compact('products','categories'));
    }
}
