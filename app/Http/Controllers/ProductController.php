<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
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
            $products = Product::where('categories.owner',$owner)
                ->leftJoin('categories','categories.id','=','products.category_id')
                ->select([
                    'products.image',
                    'products.id',
                    'products.name',
                    'products.sku',
                    'products.purchase_price',
                    'products.selling_price',
                    'products.stock_quantity',
                    'categories.name as category',
                ])
                ->get();
            return view('products.index',['products' => $products]);
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
            $categories = Category::pluck('name', 'id');
            return view('products.create',['categories'=>$categories]);
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
            $name             = strip_tags($request['name']);
            $sku              = strip_tags($request['sku']); 
            $category         = strip_tags($request['category']); 
            $stock            = strip_tags($request['stock']); 
            $purchase_price   = strip_tags($request['purchase_price']);
            $weight           = strip_tags($request['weight']);
            $selling_price    = strip_tags($request['selling_price']);
            $description      = strip_tags($request['description']);
            $image            = $request->file('product_image');
            $thumbnail = "";
            if($image != null){
                $image_name  = uniqid().'.'.$image->getClientOriginalExtension();
                $destination = 'storage/product_images';
                $image->move($destination, $image_name );
                $thumbnail = $request->getSchemeAndHttpHost().'/storage/product_images/'.$image_name;
            }
            $input['owner']          = $request->session()->get('owner');
            $input['name']           = $name;
            $input['sku']            = $sku;
            $input['description']    = $description;
            $input['weight']         = $weight;
            $input['category_id']    = 1;
            $input['purchase_price'] = $purchase_price;
            $input['selling_price']  = $selling_price;
            $input['stock_quantity'] = $stock;
            $input['image']          = $thumbnail;
            $product = Product::create($input);
            return redirect('/products');
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        try{
            return view('products.show',['product'=>$product]);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        try{
            $categories = Category::pluck('name', 'id');
            return view('products.edit',['categories'=>$categories,'product'=>$product]);
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        try {
            $name             = strip_tags($request['name']);
            $sku              = strip_tags($request['sku']); 
            $category         = strip_tags($request['category']); 
            $stock            = strip_tags($request['stock']); 
            $purchase_price   = strip_tags($request['purchase_price']);
            $weight           = strip_tags($request['weight']);
            $selling_price    = strip_tags($request['selling_price']);
            $description      = strip_tags($request['description']);
            $image            = $request->file('product_image');
            if($image != null){
                $image_name  = uniqid().'.'.$image->getClientOriginalExtension();
                $destination = 'storage/product_images';
                $image->move($destination, $image_name );
                $thumbnail = $request->getSchemeAndHttpHost().'/storage/product_images/'.$image_name;
                $product->image = $thumbnail;
            }
            $product->name           = $name;
            $product->sku            = $sku;
            $product->description    = $description;
            $product->weight         = $weight;
            $product->category_id    = $category;
            $product->purchase_price = $purchase_price;
            $product->selling_price  = $selling_price;
            $product->stock_quantity = $stock;
            $product->save();
            return redirect('/products');
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        try{
            Product::destroy($product->id);
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
    
    public function getProducts(Request $request){
        try {
            $owner =  $request->bearerToken();
            $products = Product::where('owner',$owner)->get();
            return response()->json($products,200);
        } catch (\Exception $e) {
            return [];
        }
    }
}
