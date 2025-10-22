<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CaregoryCreatingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    use WithoutMiddleware;
    protected User $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_create_category(): void
    {
        $category = Category::factory()->make();

        $response = $this->actingAs($this->user)->post(route('categories.store'), $category->toArray());

        $response
            ->assertStatus(302)
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('success', 'Category created successfully');

        $this->assertDatabaseHas('categories', $category->toArray());
    }

    public function test_category_name_is_required(): void
    {
        $category = ['description' => 'description'];

        $response = $this->actingAs($this->user)->post(route('categories.store'), $category);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors('name', 'The name field is required.');

        $this->assertDatabaseMissing('categories', $category);
    }

    public function test_check_category_name_must_be_at_least_3_characters(): void
    {
        $category = ['name' => 'qw', 'description' => 'description'];

        $response = $this->actingAs($this->user)->post(route('categories.store'), $category);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('categories', $category);
    }

    public function test_check_category_name_must_be_at_most_255_characters(): void
    {
        $category = [
            'name' => str_repeat('a', 256),
            'description' => 'description'
        ];

        $response = $this->actingAs($this->user)->post(route('categories.store'), $category);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('categories', $category);
    }




    public function test_check_category_description_must_be_at_most_1000_characters(): void
    {
        $category = [
            'name' => 'test name',
            'description' => str_repeat('a', 1001),
        ];

        $response = $this->actingAs($this->user)->post(route('categories.store'), $category);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors('description');

        $this->assertDatabaseMissing('categories', $category);
    }
}
