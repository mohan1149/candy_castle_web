<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Employee;
use App\Models\Product;

class SettingsController extends Controller
{
    //
    private $error;
    private $line;
    private $file;

    public function __construct()
    {
        $this->error = "Error = ";
        $this->line = ";Line = ";
        $this->file = ";File = ";
    }

    public function changeAppLanguage(Request $request){
        $locale = app()->getLocale();
        $locale = $locale == 'en' ? 'ar' : 'en';
        $request->session()->put('lang', $locale);
        return redirect()->back();
    }

    public function settings(Request $request)
    {
        try{
            $owner  = $request->session()->get('owner');
            $currencies =  DB::table('currencies')->get();
            $shipping_charge =  DB::table('settings')
                ->join('currencies','currencies.id','=','settings.currency')
                ->where('owner',$owner)
                ->select(['shipping_charge','currency_code'])    
                ->first();
            $data = [
                'currency'=>$currencies,
                'shipping_charge' =>$shipping_charge,
            ];
            return view('settings.index',['data'=>$data]);
        }catch(\Exception $e){
            $output = [
                'sucess' => false,
                'msg' => $this->error.$e->getMessage().$this->line.$e->getLine().$this->file.$e->getFile(),
                'code'=> 500,
            ];
            return view('500',['error' => $output]);
        }
    }

    public function setShippingCharge(Request $request){
        try {
            $owner  = $request->session()->get('owner');
            $charge = strip_tags($request['shipping_charge']);
            $insert = DB::table('settings')
                ->insert([
                    'owner' =>$owner,
                    'shipping_charge'=> $charge,
                ]);
                return redirect()->back();
        }catch(\Exception $e){
            $output = [
                'sucess' => false,
                'msg' => $this->error.$e->getMessage().$this->line.$e->getLine().$this->file.$e->getFile(),
                'code'=> 500,
            ];
            return view('500',['error' => $output]);
        }
    }

    public function editShippingCharge(Request $request){
        try {
            $owner  = $request->session()->get('owner');
            $charge = strip_tags($request['shipping_charge']);
            $update = DB::table('settings')
            ->where('owner',$owner)
                ->update([
                    'shipping_charge'=> $charge,
                ]);
                return redirect()->back();
        }catch(\Exception $e){
            $output = [
                'sucess' => false,
                'msg' => $this->error.$e->getMessage().$this->line.$e->getLine().$this->file.$e->getFile(),
                'code'=> 500,
            ];
            return view('500',['error' => $output]);
        }
    }

    //API Functions for Mobile APP
    public function appDashboard(Request $request){
        try {
            $owner =  $request->bearerToken();
            $services = Service::where('owner',$owner)
                ->select(['id','name','charge','thumbnail','duration','description'])
                ->limit(8)->get();
            $experts = Employee::where('owner',$owner)
                ->select(['id','name','profile_picture','rating'])
                ->limit(8)->get();
            $products = Product::where('owner',$owner)
                ->select(['id','name','description','image','selling_price'])
                ->limit(6)->get();
            $dashboard = [
                'services' =>  $services,
                'experts' =>  $experts,
                'products' =>  $products,
            ];
            return response()->json($dashboard, 200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 200);
        }
    }

    public function getCharge(Request $request){
        try {
            $owner =  $request->bearerToken();
            $shipping_charge =  DB::table('settings')
                ->select(['shipping_charge'])
                ->where('owner',$owner)
                ->first();
            return response()->json($shipping_charge, 200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 200);
        }
    }

    public function getCurrency(Request $request){
        try {

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 200);
        }
    }

    
}
