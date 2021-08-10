<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salon;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
            $employees = Employee::where('owner',$owner)->get();
            return view('employees.index',['employees'=>$employees]);
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
            $services = Service::where('owner',$owner)->pluck('name','id');
            return view('employees.create',['salons'=>$salons,'services'=>$services]);
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
            $name      = strip_tags($request['name']);
            $salon_id  = strip_tags($request['salon']); 
            $civil_id  = strip_tags($request['civil_id']); 
            $phone     = strip_tags($request['phone']); 
            $email     = strip_tags($request['email']); 
            $address   = strip_tags($request['address']); 
            $password  = Hash::make(strip_tags($request['civil_id'])); 
            $expert_in = $request['expert_in'];
            $image     = $request->file('employee_image');
            $thumbnail = "";
            if($image != null){
                $image_name  = uniqid().'.'.$image->getClientOriginalExtension();
                $destination = 'storage/employee_images';
                $image->move($destination, $image_name );
                $thumbnail = $request->getSchemeAndHttpHost().'/storage/employee_images/'.$image_name;
            }
            $input['owner']           = $request->session()->get('owner');
            $input['salon_id']        = $salon_id;
            $input['name']            = $name;
            $input['phone']           = $phone;
            $input['civil_id']        = $civil_id;
            $input['email']           = $email;
            $input['profile_picture'] = $thumbnail;
            $input['expert_in']       = $expert_in;
            $input['role']            = 0;
            $input['address']         = $address;
            $input['password']        = $password;
            Employee::create($input);
            return redirect('/employees');
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee,Request $request)
    {
        //
        try{
            $owner  = $request->session()->get('owner');
            return view('employees.show',['employee'=>$employee]);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee, Request $request)
    {
        //
        try{
            $owner  = $request->session()->get('owner');
            $salons = Salon::where('owner',$owner)->pluck('name','id');
            $services = Service::where('owner',$owner)->pluck('name','id');
            return view('employees.edit',['salons'=>$salons,'services'=>$services,'employee'=>$employee]);
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
        try {
            $name      = strip_tags($request['name']);
            $salon_id  = strip_tags($request['salon']); 
            $civil_id  = strip_tags($request['civil_id']); 
            $phone     = strip_tags($request['phone']); 
            $email     = strip_tags($request['email']); 
            $address   = strip_tags($request['address']); 
            $expert_in = $request['expert_in'];
            $image     = $request->file('employee_image');
            $thumbnail = "";
            if($image != null){
                $image_name  = uniqid().'.'.$image->getClientOriginalExtension();
                $destination = 'storage/employee_images';
                $image->move($destination, $image_name );
                $thumbnail = $request->getSchemeAndHttpHost().'/storage/employee_images/'.$image_name;
                $employee->profile_picture = $thumbnail;
            }
            $employee->salon_id  = $salon_id;
            $employee->name      = $name;
            $employee->phone     = $phone;
            $employee->civil_id  = $civil_id;
            $employee->email     = $email;
            $employee->expert_in = $expert_in;
            $employee->address   = $address;
            $employee->save();
            return redirect('/employees');
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        try{
            Employee::destroy($employee->id);
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

    /**
     *  Authenticate Employee
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $civil_id = strip_tags($request['civil_id']);
            $password = strip_tags($request['password']);
            $employee = Employee::where('civil_id',$civil_id)
                ->first();
                if(isset($employee)){
                    if( Hash::check($password, $employee->password) ){
                        $output = [
                            'sucess' => true,
                            'msg' => __('login sucess'),
                            'code' => 200,
                            'data' => $employee->id,
                        ];
                        $request->session()->put('role', 'emp');
                        $request->session()->put('owner', $employee->owner);
                        $request->session()->put('salon', $employee->salon_id);
                        return redirect('/dashboard');
                    }else{
                        $output = [
                            'sucess' => false,
                            'msg' => __('incorrect_password'),
                            'code' => 401,
                        ];
                    }
                }else{
                    $output = [
                        'sucess' => false,
                        'msg' => __('incorrect_civil_id'),
                        'code' => 404,
                    ];
                }
                return view('employees.login',['output'=>$output]);
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
     * Employee Dashboard
     */
    public function dashboard()
    {
        try{
            return view('employees.dashboard');
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
