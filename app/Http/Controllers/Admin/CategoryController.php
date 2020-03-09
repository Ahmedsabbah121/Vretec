<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Category;
use App\SubCategory;
use Str;
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
        $category = Category::create($this->StoreDataValidation());
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
        // dd($category['id']->subcategory->subcategory_name);
        $sub_cats = SubCategory::where('category_id',$category->id)->get();
        // dd($sub_cat);
        return view('Admins.categories.show', compact('category','sub_cats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('Admins.categories.edit',compact('category'));
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

        $category->update($this->UpdateDataValidation());
        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return back();
    }

    public function UpdateDataValidation(){
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
    public function StoreDataValidation(){
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
            $image = request('image');
            $image_name = Str::random(20);
			$exe = strtolower($image->getClientOriginalExtension());
			$image_full_name = $image_name.'.'.$exe;
			$upload_path = 'images/categories';
			$image_url = $image_full_name;
			$image->move($upload_path,$image_full_name);
            $category->update([
                'category_image'=> $image_url
            ]
            );
        }

    }

}
