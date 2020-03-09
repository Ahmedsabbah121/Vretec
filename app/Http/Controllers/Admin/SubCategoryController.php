<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Category;
use App\SubCategory;
use Validator;
use Str;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
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
    public function create(Category $category)
    {
        return view('Admins.categories.create-sub-category',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $Category , Request $request)
    {
        $SubCategory = new SubCategory;
        // dd('false');

        $validator = Validator::make($request->all(), [
		    'subcategory_name'=>'required|min:3',
            'image'=>'file|image|mimes:jpeg,png,jpg|max:5120'
		]);

		if ($validator->fails()) {
		    return redirect('/admin/categories');
		}
		else{
            $data = array();
            $image = $request->file('image');
            if($image){
                $image_name = Str::random(20);
                $ext = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'images/categories';
                $image_url = $image_full_name;
                $success=$image->move($upload_path,$image_full_name);
                if($success){
                    $data['image'] = $image_url;
                }
                else{
                    return redirect('/admin/categories');
                }
            }
            $SubCategory->category_id = $Category->id;
            $SubCategory->subcategory_name = request('subcategory_name');
            $SubCategory->subcategory_image = $data['image'];
            $SubCategory->save();
            return redirect('/admin/categories');
        }











    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }
    public static function StoreDataValidation(){
        return tap(
            request()->validate([
            'subcategory_name'=>'required|min:3',
            ]),function(){
                if(request()->hasFile('image')){
                    request()->validate([
                        'image'=>'file|image|mimes:jpeg,png,jpg|max:5120'
                    ]);
                }
        });
    }
    public function storeImage($SubCategory){

        if(request()->has('image')){
            $image = request('image');
            $image_name = Str::random(20);
			$exe = strtolower($image->getClientOriginalExtension());
			$image_full_name = $image_name.'.'.$exe;
			$upload_path = 'images/categories';
			$image_url = $image_full_name;
			$image->move($upload_path,$image_full_name);
            $SubCategory->update([
                'subcategory_image'=> $image_url
            ]
            );
        }
    }
}
