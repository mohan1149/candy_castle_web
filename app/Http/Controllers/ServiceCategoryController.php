<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;

use App\Models\Salon;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
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
            $serviceCategories = ServiceCategory::where('owner',$owner)->get();
            return view('services.category.index',['serviceCategories'=>$serviceCategories]);
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
            $salon = Salon::where('owner',$owner)->pluck('name','id');
            return view('services.category.create',['salon'=>$salon]);
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
            $salon       = $request['salon'];
            $description = strip_tags($request['description']);
            $input['owner']       = $request->session()->get('owner');
            $input['salon_id']    = $salon;
            $input['name']        = $name;
            $input['description'] = $description;
            ServiceCategory::create($input);
            return redirect('/service-categories');
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
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ServiceCategory $serviceCategory)
    {
        //
        try{
            $owner  = $request->session()->get('owner');
            $salon = Salon::where('owner',$owner)->pluck('name','id');
            return view('services.category.edit',['salon'=>$salon,'serviceCategory'=>$serviceCategory]);
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
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        //
        try {
            $name        = strip_tags($request['name']);
            $salon       = $request['salon'];
            $description = strip_tags($request['description']);

            $serviceCategory->salon_id    = $salon;
            $serviceCategory->name        = $name;
            $serviceCategory->description= $description;
            $serviceCategory->save();
            return redirect('/service-categories');
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
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceCategory $serviceCategory)
    {
        //
        try{
            ServiceCategory::destroy($serviceCategory->id);
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


    public function getServiceCategories(Request $request){
        try {
            $owner =  $request->bearerToken();
            $serviceCategories = ServiceCategory::where('owner',$owner)->get();
            return response()->json($serviceCategories, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 200);
        }   
    }
}
