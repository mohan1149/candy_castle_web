<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Salon;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;

class ServiceController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        try{
            $owner  = $request->session()->get('owner');
            $services = Service::where('owner',$owner)->get();
            return view('services.index',['services'=>$services]);
        }catch(\Exception $e){
            $output = [
                'sucess' => false,
                'msg' => $this->error.$e->getMessage().$this->line.$e->getLine().$this->file.$e->getFile(),
                'code'=> 500,
            ];
            return view('500',['error' => $output]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try{
            $owner  = $request->session()->get('owner');
            $salons = Salon::where('owner',$owner)->pluck('name','id');
            $services_categories = ServiceCategory::where('owner',$owner)->pluck('name','id');
            return view('services.create',['salons'=>$salons,'services_categories'=>$services_categories]);
        }catch(\Exception $e){
            $output = [
                'sucess' => false,
                'msg' => $this->error.$e->getMessage().$this->line.$e->getLine().$this->file.$e->getFile(),
                'code'=> 500,
            ];
            return view('500',['error' => $output]);
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
        //
        try {
            $name        = strip_tags($request['name']);
            $charge      = strip_tags($request['charge']); 
            $duration    = strip_tags($request['duration']); 
            $salons      = $request['salons'];
            $description = strip_tags($request['description']);
            $image       = $request->file('service_image');
            $thumbnail   = "";
            if($image != null){
                $image_name  = uniqid().'.'.$image->getClientOriginalExtension();
                $destination = 'storage/services_images';
                $image->move($destination, $image_name );
                $thumbnail = $request->getSchemeAndHttpHost().'/storage/services_images/'.$image_name;
            }
            $input['owner']       = $request->session()->get('owner');
            $input['salon_id']    = $salons;
            $input['name']        = $name;
            $input['charge']      = $charge;
            $input['thumbnail']   = $thumbnail;
            $input['duration']    = $duration;
            $input['description'] = $description;
            Service::create($input);
            return redirect('/services');
        } catch (\Exception $e) {
            $output = [
                'sucess' => false,
                'msg' => $this->error.$e->getMessage().$this->line.$e->getLine().$this->file.$e->getFile(),
                'code'=> 500,
            ];
            return view('500',['error' => $output]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service, Request $request)
    {
        //
        try{
            $owner  = $request->session()->get('owner');
            $salons = Salon::where('owner',$owner)->pluck('name','id');
            $services_categories = ServiceCategory::where('owner',$owner)->pluck('name','id');
            return view('services.edit',['salons'=>$salons,'services_categories'=>$services_categories,'service'=>$service]);
        }catch(\Exception $e){
            $output = [
                'sucess' => false,
                'msg' => $this->error.$e->getMessage().$this->line.$e->getLine().$this->file.$e->getFile(),
                'code'=> 500,
            ];
            return view('500',['error' => $output]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
        try {
            $name        = strip_tags($request['name']);
            $charge      = strip_tags($request['charge']); 
            $duration    = strip_tags($request['duration']); 
            $salons      = $request['salons'];
            $description = strip_tags($request['description']);
            $service_category = $request['service_category'];
            $image       = $request->file('service_image');
            if($image != null){
                $image_name  = uniqid().'.'.$image->getClientOriginalExtension();
                $destination = 'storage/services_images';
                $image->move($destination, $image_name );
                $thumbnail = $request->getSchemeAndHttpHost().'/storage/services_images/'.$image_name;
                $service->thumbnail = $thumbnail;
            }
            $service->service_category_id = $service_category;
            $service->salon_id = $salons;
            $service->name = $name;
            $service->duration = $duration;
            $service->charge = $charge;
            $service->description = $description;
            $service->save();
            return redirect('/services');
        } catch (\Exception $e) {
            $output = [
                'sucess' => false,
                'msg' => $this->error.$e->getMessage().$this->line.$e->getLine().$this->file.$e->getFile(),
                'code'=> 500,
            ];
            return view('500',['error' => $output]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
        try{
            Service::destroy($service->id);
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


    // APIS for my_salon APP
    
    public function getServices(Request $request){
        try{
            $owner =  $request->bearerToken();
            $services = Service::where('owner',$owner)->get();
            return response()->json($services, 200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 200);
        }
    }
}
