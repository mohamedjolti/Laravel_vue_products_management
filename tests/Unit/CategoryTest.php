<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Category; 

class CategoryTest extends TestCase
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
    public function test_can_create_category() {
        $categories = Category::pluck('id')->toArray();
        $data = [
            'name' =>  $this->faker->sentence,
            'parent_category'=> $this->faker->randomElement($categories)
        ];

        $this->post(route('category.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }
}
