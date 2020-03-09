<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Order;
use App\Cart;
use App\Http\Controllers\Api\CartController;
use Illuminate\Http\Request;
use Validator;
class OrderController extends Controller
{
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
        $cartItems = array();
        $cart_ids = array();
        $order = new Order;
        $cart = new Cart;
        $rules = [
            'user_id'=>'required|numeric',
            'api_token'=>'required|exists:users,api_token',
            'total_price'=>'required'
        ];
        $validator = Validator::make(request()->all(),$rules);
            if($validator->fails()){
                result(401,$validator->messages(),null);
            }
            else{
                if(CartController::isLogin(request('api_token'),request('user_id')) == true){
                    $ordered_before = Order::where('user_id',request('user_id'))->get();
                    if(empty($ordered_before)){
                        $order->user_id = request('user_id');
                        $order->total_price =request('total_price');
                        $order->save();
                        Cart::where('user_id',request('user_id'))->update([
                            'billing_status'=>'done',
                            'order_id'=>$order->id
                        ]);
                        result(200,null,null);
                    }
                    else{
                        result(401,'there is order already exist for this user',null);
                    }

                }else{
                    result(401,null,null);
                }
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
