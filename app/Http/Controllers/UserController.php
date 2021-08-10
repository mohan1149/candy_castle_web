<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserController extends Controller
{
    
    public function userLogin(Request $request){
        try{
            $civil_id = strip_tags($request['civil_id']);
            $password = strip_tags($request['password']);
            $user = User::where('civil_id',$civil_id)
                ->first();
            if(isset($user)){
                if( Hash::check($password, $user->password) ){
                    $request->session()->put('owner', $user->id);
                    $request->session()->put('role', 'admin');
                    return redirect('/home');
                }else{
                    $output = [
                        'sucess' => false,
                        'msg' => __('t.incorrect_password'),
                        'code' => 401,
                    ];
                }
            }else{
                $output = [
                    'sucess' => false,
                    'msg' => __('t.incorrect_civil_id'),
                    'code' => 404,
                ];
            }
            return view('welcome',[ 'output'=> $output ]);
        }catch(\Exception $e){
            $output = [
                'sucess' => false,
                'msg' => 'Error= '.$e->getMessage().';Line = '.$e->getLine().';File='.$e->getFile(),
                'code'=> 500,
            ];
            return view('welcome',[ 'output'=> $output ]);
        }
    }
}
