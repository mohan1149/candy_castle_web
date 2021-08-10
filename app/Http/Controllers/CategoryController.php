<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
            $categories = Category::where('owner',$owner)->get();
            return view('categories.index',['categories'=>$categories]);
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
            return view('categories.create');
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
        //
        try {
            $name  = strip_tags($request['name']);
            $desc  = strip_tags($request['description']);
            $image = $request->file('category_image');
            $thumbnail = "";
            if($image != null){
                $image_name  = uniqid().'.'.$image->getClientOriginalExtension();
                $destination = 'storage/category_images';
                $image->move($destination, $image_name );
                $thumbnail = $request->getSchemeAndHttpHost().'/storage/category_images/'.$image_name;
            }
            $input['owner']       = $request->session()->get('owner');
            $input['name']        = $name;
            $input['description'] = $desc;
            $input['thumbnail']   = $thumbnail;
            $salon = Category::create($input);
            return redirect('/categories');
        } catch (\Exception $e) {
            $output = [
                'sucess' => false,
                'msg' => 'Error= '.$e->getMessage().';Line = '.$e->getLine().';File='.$e->getFile(),
                'code'=> 500,
            ];
            return view('categories.create',['output' => $output]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Request $request)
    {
        $owner  = $request->session()->get('owner');
        $input =  $category->where('id',$category->id)
            ->where('owner',$owner)
            ->first();
        try{
            return view('categories.edit',['input' => $input]);
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            $name  = strip_tags($request['name']);
            $desc  = strip_tags($request['description']);
            $image = $request->file('category_image');
            if($image != null){
                $image_name  = uniqid().'.'.$image->getClientOriginalExtension();
                $destination = 'storage/category_images';
                $image->move($destination, $image_name );
                $thumbnail = $request->getSchemeAndHttpHost().'/storage/category_images/'.$image_name;
                $category->thumbnail = $thumbnail;
            }
            $category->name = $name;
            $category->description = $desc;
            $category->save();
            return redirect('/categories');
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        try{
            Category::destroy($category->id);
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
    public function getCategories(Request $request){
        try{
            $owner   =  $request->bearerToken();
            $categories = Category::where('owner',$owner)->get();
            return  response()->json($categories, 200);
        }catch(\Exception $e){
            return  response()->json($e->getMessage(), 200);
        }
    }
}
