<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json( Category::all() ,201);
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
        //
        public function store(Request $request)
        { 
            //validation
            //rules of each field
            $rules = [
                'name' => 'required',
            ];
            //message for each rule
            $messages = [
                'name.required' => 'name is required',
              ];
    
        
           $validator=Validator::make($request->all(),$rules,$messages);
       // if the one the field is not valide

           if($validator->fails()){
                    return response()->json($validator->messages(), 200);
           }
        //creation of new category
        
        $category = Category::create($request->all());
        return response()->json( $category ,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //

        $category->update($request->all());

        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();

        return response()->json(null, 204);
    }
}
