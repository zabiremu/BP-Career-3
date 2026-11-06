<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
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
            ->route('admin.products.create')
            ->with('success', 'Product created successfully.');
    }
}
