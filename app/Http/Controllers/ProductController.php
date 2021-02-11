<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Validator;
use App\Services\Validation;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public Function Upload(Request $request,$Name_File){   
        //get the file name
        $filenameWithExt = $request->file($Name_File)->getClientOriginalName();
        
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get extansion
        $extension = $request->file($Name_File)->getClientOriginalExtension();
        //get the name of the file
        $filenameToStore = $filename.'.'.$extension;
         // store the image
        $path= $request->file($Name_File)->storeAs('public/photos/',$filenameToStore);  
    }

    public function index()
    {
        //
        return response()->json( Product::all() ,201);
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
        //validation
        if(Validation::validatorCreateProduct($request->all())!==true){
            return Validation::validatorCreateProduct($request->all());
        };

        // creation of new product
        $product=new Product($request->all());
        $product->image=$request->file("image")->getClientOriginalName();
        $product->save();
        $this->Upload($request,"image");

        return response()->json( $product ,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $Product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $Product)
    {
        //

        $Product->update($request->all());

        return response()->json($Product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $Product)
    {
        //
        $Product->delete();

        return response()->json(null, 204);
    }
}
