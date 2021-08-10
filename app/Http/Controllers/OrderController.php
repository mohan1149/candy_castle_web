<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Events\OrderPlaced;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        try{
            $owner  = $request->session()->get('owner');
            $orders = Order::where('owner',$owner)
                ->get();
            return view('orders.index',['orders' => $orders]);
        }catch(\Exception $e){
            $error = [
                'sucess' => false,
                'msg' => 'Error= '.$e->getMessage().';Line = '.$e->getLine().';File='.$e->getFile(),
                'code'=> 500,
            ];
            return view('500',['error' => $error]);
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
        try{
            Cart::where('order_id', $order->id)->delete();
            Order::destroy($order->id);
            return response()->json('success', 200);
        }catch(\Exception $e){
            $error = [
                'sucess' => false,
                'msg' => 'Error= '.$e->getMessage().';Line = '.$e->getLine().';File='.$e->getFile(),
                'code'=> 500,
            ];
            return response()->json($error, 200);
        }
    }

     //API's for MySalon Mobile APP


    public function updateOrder(Request $request){
        try {
            $id  = $request['order'];
            $status = $request['status'];
            $order  = Order::find($id);
            $order->status = $status;
            $order->save();
            return $order->id;
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function placeOrder(Request $request){
        try {
            $owner   =  $request->bearerToken();
            $shipping_charge =  DB::table('settings')
                ->select(['shipping_charge'])
                ->where('owner',$owner)
                ->first();
            $cost    = $request['cost'];
            $method  = $request['method'];
            $address = $request['address'];
            $items   = $request['items'];
            $user    = $request['user'];
            $input['owner']             = $owner;
            $input['status']            = 0;
            $input['order_cost']        = $cost + $shipping_charge->shipping_charge;
            $input['customer_id']       = $user;
            $input['payment_method']    = $method;
            $input['delivery_address']  = json_encode($address);
            $input['trasaction_number'] = time();
            $order = Order::create($input);
            foreach($items as $item){
                $cart['order_id']   = $order->id;
                $cart['product_id'] = $item['id'];
                $cart['quantity']   = $item['quantity'];
                Cart::create($cart);
            }
            event(new OrderPlaced($order));
            return response()->json($order->id, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage().$e->getLine(), 200);
        }
    }
    public function getOrders(Request $request){
        try{
            $user  = $request['user'];
            $orders = Order::where('customer_id',$user)
                ->get();
            return response()->json($orders, 200);
        }catch(\Exception $e){
            return [];
        }
    }

}
