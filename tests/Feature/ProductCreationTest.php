<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_form_lists_active_categories_and_their_subcategories(): void
    {
        $category = Category::create([
            'name' => 'Furniture',
            'slug' => 'furniture',
            'status' => 'Active',
        ]);

        Category::create([
            'name' => 'Chairs',
            'slug' => 'chairs',
            'parent_id' => $category->id,
            'status' => 'Active',
        ]);

        Category::create([
            'name' => 'Hidden Category',
            'slug' => 'hidden-category',
            'status' => 'Inactive',
        ]);

        $response = $this->get(route('admin.products.create'));

        $response->assertOk()
            ->assertSee('Furniture')
            ->assertSee('Chairs')
            ->assertDontSee('Hidden Category');
    }

    public function test_product_is_created_with_its_image_and_prices(): void
    {
        Storage::fake('public');

        $category = Category::create([
            'name' => 'Furniture',
            'slug' => 'furniture',
            'status' => 'Active',
        ]);

        $subcategory = Category::create([
            'name' => 'Chairs',
            'slug' => 'chairs',
            'parent_id' => $category->id,
            'status' => 'Active',
        ]);

        $response = $this->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'name' => 'Reading Chair',
            'description' => 'A comfortable chair.',
            'image' => UploadedFile::fake()->image('chair.jpg'),
            'old_price' => '120.00',
            'new_price' => '95.00',
        ]);

        $response->assertRedirect(route('admin.products.create'))
            ->assertSessionHas('success', 'Product created successfully.');

        $product = Product::firstOrFail();

        $this->assertSame($category->id, $product->category_id);
        $this->assertSame($subcategory->id, $product->subcategory_id);
        $this->assertSame('Reading Chair', $product->name);
        $this->assertSame('120.00', $product->old_price);
        $this->assertSame('95.00', $product->new_price);
        Storage::disk('public')->assertExists($product->image);
    }

    public function test_subcategory_must_belong_to_the_selected_category(): void
    {
        $category = Category::create([
            'name' => 'Furniture',
            'slug' => 'furniture',
            'status' => 'Active',
        ]);

        $otherCategory = Category::create([
            'name' => 'Lighting',
            'slug' => 'lighting',
            'status' => 'Active',
        ]);

        $subcategory = Category::create([
            'name' => 'Lamps',
            'slug' => 'lamps',
            'parent_id' => $otherCategory->id,
            'status' => 'Active',
        ]);

        $response = $this->from(route('admin.products.create'))
            ->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'subcategory_id' => $subcategory->id,
                'name' => 'Desk Lamp',
                'new_price' => '25.00',
            ]);

        $response->assertRedirect(route('admin.products.create'))
            ->assertSessionHasErrors('subcategory_id');

        $this->assertDatabaseCount('products', 0);
    }
}
