<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller
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
        $categories = Category::all();
        return view('Admins.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return view('Admins.categories.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($this->DataValidation());
        $this->storeImage($category);
        return redirect('/admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
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
    public function destroy(Category $category)
    {
        //
    }

    public function DataValidation(){
        return tap(
            request()->validate([
            'category_name'=>'required|min:3',
            ]),function(){
                if(request()->hasFile('category_image')){
                    request()->validate([
                        'category_image'=>'file|image|mimes:jpeg,png,jpg|max:5120'
                    ]);
                }
        });
    }

    public function storeImage($category){
        if(request()->has('image')){
            $category->update([
                'category_image'=> request()->image->store('categories','public')
            ]
            );
        }
    }

}
