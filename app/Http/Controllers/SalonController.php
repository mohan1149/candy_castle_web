<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SalonController extends Controller
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
            $salons = Salon::where('owner',$owner)->get();
            return view('salons.index',['salons'=>$salons]);
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
        try{
            return view('salons.create');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $name      = strip_tags($request['name']);
            $phone     = strip_tags($request['phone']); 
            $opening   = strip_tags($request['opening']); 
            $closing   = strip_tags($request['closing']); 
            $address   = strip_tags($request['address']);
            $image     = $request->file('salon_image');
            $thumbnail = "";
            if($image != null){
                $image_name  = uniqid().'.'.$image->getClientOriginalExtension();
                $destination = 'storage/salon_images';
                $image->move($destination, $image_name );
                $thumbnail = $request->getSchemeAndHttpHost().'/storage/salon_images/'.$image_name;
            }
            $input['owner']     = $request->session()->get('owner');
            $input['name']      = $name;
            $input['phone']     = $phone;
            $input['thumbnail'] = $thumbnail;
            $input['address']   = $address;
            $input['opening']   = $opening;
            $input['closing']   = $closing;
            $salon = Salon::create($input);
            return redirect('/salons');
        } catch (\Exception $e) {
            $output = [
                'sucess' => false,
                'msg' => 'Error= '.$e->getMessage().';Line = '.$e->getLine().';File='.$e->getFile(),
                'code'=> 500,
            ];
            return view('salons.create',['output' => $output]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function show(Salon $salon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function edit(Salon $salon)
    {
        //
        try{
            return view('salons.edit',['salon'=>$salon]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salon $salon)
    {
        //
        try {
            $name      = strip_tags($request['name']);
            $phone     = strip_tags($request['phone']); 
            $opening   = strip_tags($request['opening']); 
            $closing   = strip_tags($request['closing']); 
            $address   = strip_tags($request['address']);
            $image = $request->file('salon_image');
            if($image != null){
                $image_name  = uniqid().'.'.$image->getClientOriginalExtension();
                $destination = 'storage/salon_images';
                $image->move($destination, $image_name );
                $thumbnail = $request->getSchemeAndHttpHost().'/storage/salon_images/'.$image_name;
                $salon->thumbnail = $thumbnail;
            }
            $salon->name = $name;
            $salon->phone = $phone;
            $salon->address = $address;
            $salon->opening = $opening;
            $salon->closing = $closing;
            $salon->save();
            return redirect('/salons');
        } catch (\Exception $e) {
            $output = [
                'sucess' => false,
                'msg' => 'Error= '.$e->getMessage().';Line = '.$e->getLine().';File='.$e->getFile(),
                'code'=> 500,
            ];
            return view('categories.edit',['output' => $output,'input' => $category]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salon  $salon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salon $salon)
    {
        //
        try{
            Salon::destroy($salon->id);
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
}
