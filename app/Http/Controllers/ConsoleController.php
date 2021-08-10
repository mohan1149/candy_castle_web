<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class ConsoleController extends Controller
{
    private $error;
    private $line;
    private $file;

    public function __construct()
    {
        $this->error = "Error = ";
        $this->line = ";Line = ";
        $this->file = ";File = ";
    }

    /**
     * Console
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function console(Request $request)
    {
        try{
            $owner = $request->session()->get('owner');
            $orders = Order::where('owner',$owner)
                ->whereDate('created_at',Carbon::today())
                ->get();
            return view('console.index',['orders'=>$orders]);
        }catch(\Exception $e){
            $output = [
                'sucess' => false,
                'msg' => $this->error.$e->getMessage().$this->line.$e->getLine().$this->file.$e->getFile(),
                'code'=> 500,
            ];
            return view('500',['error' => $output]);
        }
    }
}
