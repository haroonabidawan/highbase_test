<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user for authentication
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('11223344'),
            'email_verified_at' => now(),
        ]);

        // Authenticate as the created user for all requests
        $this->actingAs($user);
    }

    /**
     * Test creating a product.
     */
    public function testCreateProduct(): void
    {
        Category::query()->create([
            'name' => 'Test Category',
        ]);

        // Make the AJAX request
        $response = $this->withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
        ])->post('admin/products', [
            'name' => 'Test Product',
            'category_id' => Category::first()->id,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }

    /**
     * Test updating a product.
     */
    public function testUpdateProduct(): void
    {
        Category::query()->create([
            'name' => 'Test Category',
        ]);
        $product = Product::query()->create([
            'name' => 'Test Product',
            'category_id' => Category::first()->id,
        ]);

        $response = $this->withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
        ])->put('admin/products/' . $product->id, [
            'name' => 'Updated Product Name',
            'category_id' => Category::first()->id,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['name' => 'Updated Product Name']);
    }

    /**
     * Test deleting a product.
     */
    public function testDeleteProduct(): void
    {
        Category::query()->create([
            'name' => 'Test Category',
        ]);
        $product = Product::query()->create([
            'name' => 'Test Product',
            'category_id' => Category::first()->id,
        ]);

        $response = $this->withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
        ])->delete('admin/products/' . $product->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
