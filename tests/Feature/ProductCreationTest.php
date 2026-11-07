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

    public function test_product_list_displays_saved_product_details(): void
    {
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

        Product::create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'name' => 'Reading Chair',
            'description' => 'A comfortable chair.',
            'image' => 'products/chair.jpg',
            'old_price' => '120.00',
            'new_price' => '95.00',
        ]);

        $this->get(route('admin.products.index'))
            ->assertOk()
            ->assertSee('Reading Chair')
            ->assertSee('A comfortable chair.')
            ->assertSee('Furniture')
            ->assertSee('Chairs')
            ->assertSee('120.00')
            ->assertSee('95.00')
            ->assertSee(route('admin.products.create'));
    }

    public function test_product_edit_form_displays_saved_values(): void
    {
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

        $product = Product::create([
            'category_id' => $category->id,
            'subcategory_id' => $subcategory->id,
            'name' => 'Reading Chair',
            'description' => 'A comfortable chair.',
            'image' => 'products/chair.jpg',
            'old_price' => '120.00',
            'new_price' => '95.00',
        ]);

        $this->get(route('admin.products.edit', $product))
            ->assertOk()
            ->assertSee('Edit Product: Reading Chair')
            ->assertSee('value="Reading Chair"', false)
            ->assertSee('A comfortable chair.')
            ->assertSee('value="120.00"', false)
            ->assertSee('value="95.00"', false)
            ->assertSee('Chairs');
    }

    public function test_product_can_be_updated_without_replacing_its_image(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('products/chair.jpg', 'existing image');

        $category = Category::create([
            'name' => 'Furniture',
            'slug' => 'furniture',
            'status' => 'Active',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Reading Chair',
            'description' => 'Original description.',
            'image' => 'products/chair.jpg',
            'old_price' => '120.00',
            'new_price' => '95.00',
        ]);

        $response = $this->put(route('admin.products.update', $product), [
            'category_id' => $category->id,
            'name' => 'Updated Chair',
            'description' => 'Updated description.',
            'old_price' => '110.00',
            'new_price' => '90.00',
        ]);

        $response->assertRedirect(route('admin.products.index'))
            ->assertSessionHas('success', 'Product updated successfully.');

        $product->refresh();

        $this->assertSame('Updated Chair', $product->name);
        $this->assertSame('Updated description.', $product->description);
        $this->assertNull($product->subcategory_id);
        $this->assertSame('products/chair.jpg', $product->image);
        $this->assertSame('110.00', $product->old_price);
        $this->assertSame('90.00', $product->new_price);
        Storage::disk('public')->assertExists('products/chair.jpg');
    }

    public function test_product_update_replaces_and_removes_the_previous_image(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('products/chair.jpg', 'existing image');

        $category = Category::create([
            'name' => 'Furniture',
            'slug' => 'furniture',
            'status' => 'Active',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Reading Chair',
            'image' => 'products/chair.jpg',
            'new_price' => '95.00',
        ]);

        $this->put(route('admin.products.update', $product), [
            'category_id' => $category->id,
            'name' => 'Reading Chair',
            'new_price' => '95.00',
            'image' => UploadedFile::fake()->image('new-chair.jpg'),
        ])->assertRedirect(route('admin.products.index'));

        $product->refresh();

        $this->assertNotSame('products/chair.jpg', $product->image);
        Storage::disk('public')->assertExists($product->image);
        Storage::disk('public')->assertMissing('products/chair.jpg');
    }

    public function test_product_can_be_deleted_with_its_image(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('products/chair.jpg', 'product image');

        $category = Category::create([
            'name' => 'Furniture',
            'slug' => 'furniture',
            'status' => 'Active',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Reading Chair',
            'image' => 'products/chair.jpg',
            'new_price' => '95.00',
        ]);

        $this->get(route('admin.products.index'))
            ->assertOk()
            ->assertSee(route('admin.products.destroy', $product))
            ->assertSee('Delete');

        $this->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('admin.products.index'))
            ->assertSessionHas('success', 'Product deleted successfully.');

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        Storage::disk('public')->assertMissing('products/chair.jpg');
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

        $response->assertRedirect(route('admin.products.index'))
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
