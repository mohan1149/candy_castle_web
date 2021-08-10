<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $owner  = $request->session()->get('owner');
            $customers = Customer::where('owner',$owner)->get(); 
            return view('customers.index',['customers'=>$customers]);
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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }



    //API's for MySalon Mobile APP

    public function addCustomer(Request $request){
        try{
            $owner =  $request->bearerToken();
            $input['owner']    = $owner;
            $input['name']     = strip_tags($request['name']);
            $input['phone']    = strip_tags($request['phone']);
            $input['password'] = Hash::make($request['phone']);
            $input['fcm']      = $request['fcm'];
            $customer = Customer::create($input);
            return response()->json($customer, 200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 200);
        }
    }
    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        try {
            $phone = strip_tags($request['phone']);
            $password = strip_tags($request['password']);
            $customer = Customer::where('phone',$phone)
                ->first();
                if(isset($customer)){
                    if( Hash::check($password, $customer->password) ){
                        return response()->json($customer, 200);
                    }else{
                        $output = [
                            'sucess' => false,
                            'code' => 401,
                        ];
                        return response()->json($output, 200);
                    }
                }else{
                    $output = [
                        'sucess' => false,
                        'code' => 404,
                    ];
                    return response()->json($output, 200);
                }
        } catch (\Exception $e) {
            $output = [
                'sucess' => false,
                'msg' => $this->error.$e->getMessage().$this->line.$e->getLine().$this->file.$e->getFile(),
                'code'=> 500,
            ];
            return response()->json($output, 200);
        }
    }
}
