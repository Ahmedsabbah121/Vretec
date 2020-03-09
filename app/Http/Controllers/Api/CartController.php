<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Cart;
use App\Products;
use Validator;
use Illuminate\Http\Request;
use App\User;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $cart = new Cart;
        $rules = [
            'product_id'=>'required|numeric|exists:Products,product_id',//
            'quantity'=>'required|numeric',
            'days_num'=>'required|numeric',
            'start_date'=>'required',
            'end_date'=>'required',
            'address'=>'required|max:255',
            'lat'=>'required',
            'lng'=>'required',
            'user_id'=>'required',
            'api_token'=>'required|exists:users,api_token'

        ];
        $validator = Validator::make(request()->all(),$rules);
            if($validator->fails()){
                result(401,$validator->messages(),null);
            }
            else{
                if(CartController::isLogin(request('api_token'),request('user_id')) == true){
                        $add_before = Cart::where('product_id',request('product_id'))->where('user_id',request('user_id'))->where('billing_status',null)->first();
                        if(!empty($add_before)){
                            result(401);
                        }
                        else{
                            $cart->product_id =request('product_id');
                            $cart->quantity =request('quantity');
                            $cart->days_num=request('days_num');
                            $cart->start_date = request('start_date');
                            $cart->end_date = request('end_date');
                            $cart->address = request('address');
                            $cart->lat = request('lat');
                            $cart->lng = request('lng');
                            $cart->user_id = request('user_id');
                            $cart->created_at = new \DateTime();
                            $cart->updated_at = new \DateTime();
                            $cart->save();
                            result(200,null);
                        }
                }
                else{
                    result(401,'user must login first',null);
                }

            }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public  function show(Cart $cart)
    {
        $rules = [
            'user_id'=>'required|numeric|exists:users,id',
            'api_token'=>'required'
        ];
        $items = array();
        $validator = Validator::make(request()->all(),$rules);
        if($validator->fails()){
            result(401,$validator->messages(),null);
        }
        if(CartController::isLogin(request('api_token'),request('user_id')) == true){
            $userCart = Cart::where('user_id',request('user_id'))->where('billing_status',null)->get();
            if(!empty($userCart)){
                foreach($userCart as $cart){
                    $item = Products::select('product_id','name','price','image')->where('product_id',$cart->product_id)->first();


                    $item_datailes = (object)[
                        'cart_id'=>$cart->id,
                        'quantity'=>$cart->quantity,
                        'product_id'=>$item->product_id,
                        'product_name'=>$item->name,
                        'product_price'=>$item->price,
                        'product_image'=>"http://www.vretech.com/images/products/".$item->image
                    ];
                    array_push($items,$item_datailes);
                }
                if(!empty($items)){
                    result(200,'Success request',$items);
                }else{
                    result(401,'User has No items in cart',null);
                }
            }
            else{
                result(401,'User has No items in cart',null);
            }
        }else{
            result(401,'Please Login first',null);
        }

    }


    public static function isLogin($api_token,$user_id){
        $user = User::where('api_token',$api_token)->where('id',$user_id)->first();
        if($user){
            return true;
        }
        return false;
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart = new Cart;
        $rules = [
            'cart_id'=>'required|numeric|exists:carts,id',
            'user_id'=>'required|exists:users,id',
            'api_token'=>'required|exists:users,api_token'

        ];
        $validator = Validator::make(request()->all(),$rules);
        if($validator->fails()){
            result(401,$validator->messages(),null);
        }
        else{
            if(CartController::isLogin(request('api_token'),request('user_id')) == true){
                $cart = Cart::where('id',request('cart_id'))->where('billing_status','done')->first();
                if(!empty($cart)){
                    result(401,'item is not exist',null);
                }
                else{
                    Cart::where('id',request('cart_id'))->where('billing_status',null)->delete();
                    result(200,'cart deleted Successfully',null);
                }
            }else{
                result(401,'Please Login first',null);
            }
        }

    }
}
