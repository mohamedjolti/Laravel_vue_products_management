<?php

namespace App\Services;

use Validator;


class ValidationService
{

    /**
     * Get a validator for a contact.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validatorCreateCategory($data)
    {
        $rules = [
            'name' => 'required',
        ];
        //message for each rule
        $messages = [
            'name.required' => 'name is  required',
        ];


        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        } else {
            return true;
        }
    }
    public static function validatorCreateProduct($data)
    {
        //rules of each field
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
            
        ];
        //message for each rule
        $messages = [
            'name.required' => 'name is required',
            'description.required' => "description is required",
            'price.required' => "price is required",
            'category.required' => "category is required",
            'image.file' => "the image should be a file",
            'image.image' => "the image should be file of type image",
            'image.required' => "the image is required"
        ];


        $validator = Validator::make($data, $rules, $messages);
        // if the one the field is not valide
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        } else {
            return true;
        }
    }
}
