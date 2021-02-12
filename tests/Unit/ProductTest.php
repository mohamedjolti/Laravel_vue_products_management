<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Category;
use App\Services\Validation;
use App\Product;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    //get file from url 
    public function getFile($url)
    {
        //get name file by url and save in object-file
        $path_parts = pathinfo($url);
        //get image info (mime, size in pixel, size in bits)
        $newPath = $path_parts['dirname'] . '/tmp-files/';
        if(!is_dir ($newPath)){
            mkdir($newPath, 0777);
        }
        $newUrl = $newPath . $path_parts['basename'];
        copy($url, $newUrl);
        $imgInfo = getimagesize($newUrl);
        $file = new UploadedFile(
            $newUrl,
            $path_parts['basename'],
            $imgInfo['mime'],
            filesize($url),
            TRUE,
        );
        return $file;
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
        $file = $this->getFile($url);
        return  [
            'name' => $this->faker->sentence,
            'description'=>$this->faker->sentence,
            'price'=>$this->faker->randomDigit,
            'image'=>$file,
            'category'=>$this->faker->randomElement($categories)
        ];
    }
    
}
