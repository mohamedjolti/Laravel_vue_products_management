<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Category;
use App\Services\Validation;
use App\Product;
use App\Services\FileService;

class ProductTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {

        $this->assertTrue(true);
    }




    public function test_can_create_product() {
        // show the real error if a test failed
        $this->withoutExceptionHandling();
        //the fake data
        $data=$this->data();
         //test the post request (the creation of a new product)
        $this->post(route('product.store'), $data);
        $this->assertCount(1,Product::all());
    }

    //generate fake data
    private function data(){
        // fake category
        $categories = Category::pluck('id')->toArray();
        // generate new file using the methode getFile 
        $url = public_path('images/demo.png');
        $file = FileService::getFile($url);
        //retun the data
        return  [
            'name' => $this->faker->sentence,
            'description'=>$this->faker->sentence,
            'price'=>$this->faker->randomDigit,
            'image'=>$file,
            'category'=>$this->faker->randomElement($categories)
        ];
    }
    
}
