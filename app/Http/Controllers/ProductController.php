<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->with(['category', 'subcategory'])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->where('status', 'Active')
            ->with(['children' => fn ($query) => $query->where('status', 'Active')->orderBy('name')])
            ->orderBy('name')
            ->get();

        return view('admin.products.create', compact('categories'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::query()
            ->whereNull('parent_id')
            ->where(function ($query) use ($product) {
                $query->where('status', 'Active')
                    ->orWhere('id', $product->category_id);
            })
            ->with(['children' => fn ($query) => $query
                ->where(function ($query) use ($product) {
                    $query->where('status', 'Active')
                        ->orWhere('id', $product->subcategory_id);
                })
                ->orderBy('name')])
            ->orderBy('name')
            ->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(fn ($query) => $query
                    ->whereNull('parent_id')
                    ->where('status', 'Active')),
            ],
            'subcategory_id' => [
                'nullable',
                Rule::exists('categories', 'id')->where(fn ($query) => $query
                    ->where('parent_id', $request->input('category_id'))
                    ->where('status', 'Active')),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'new_price' => ['required', 'numeric', 'min:0'],
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        if ($imagePath === false) {
            abort(500, 'The product image could not be saved.');
        }

        Product::create([
            ...$validated,
            'image' => $imagePath,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(fn ($query) => $query
                    ->whereNull('parent_id')
                    ->where(function ($query) use ($product) {
                        $query->where('status', 'Active')
                            ->orWhere('id', $product->category_id);
                    })),
            ],
            'subcategory_id' => [
                'nullable',
                Rule::exists('categories', 'id')->where(fn ($query) => $query
                    ->where('parent_id', $request->input('category_id'))
                    ->where(function ($query) use ($product) {
                        $query->where('status', 'Active')
                            ->orWhere('id', $product->subcategory_id);
                    })),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'new_price' => ['required', 'numeric', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');

            if ($imagePath === false) {
                abort(500, 'The product image could not be saved.');
            }

            $oldImagePath = $product->image;
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        if (isset($oldImagePath) && $oldImagePath !== $imagePath) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if (! Storage::disk('public')->delete($product->image)) {
            abort(500, 'The product image could not be deleted.');
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
