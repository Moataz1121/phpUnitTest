<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryRetrievalTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */


    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }
    public function test_if_categories_can_be_retrieved_successfully(): void
    {

        $response = $this->get('/categories');

        $response->assertSuccessful();
        $response->assertSeeText('Categories');
        $response->assertViewIs('categories.index');
        $response->assertStatus(200);
    }


    public function test_check_if_categories_page_contain_categories(): void
    {
        Category::factory()->count(5)->create();

        $response = $this->get('/categories');

        $response->assertSeeText('Categories');
        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
        $response->assertSuccessful();
        $response->assertViewHas('categories' , function ($categories) {
            return $categories->count() === 5;
        });
    }

       public function test_check_if_pagination_works_as_expected(): void
    {
        Category::factory()->count(15)->create();

        $response = $this->get('/categories');

        $response->assertSeeText('Categories');
        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
        $response->assertSuccessful();
        $response->assertViewHas('categories' , function ($categories) {
            return $categories->count() === 10;
        });
    }

       public function test_check_if_pagination_works_as_expected_in_page_two(): void
    {
        Category::factory()->count(15)->create();

        $response = $this->get('/categories?page=2');

        $response->assertSeeText('Categories');
        $response->assertStatus(200);
        $response->assertViewIs('categories.index');
        $response->assertSuccessful();
        $response->assertViewHas('categories' , function ($categories) {
            return $categories->count() === 5;
        });
    }
}
