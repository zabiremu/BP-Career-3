@extends('admin.layouts.app')

@section('content')
    <div class="col-span-12" x-data="{ pageTitle: 'Edit Product' }">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageTitle">
                Edit Product
            </h2>
            <nav>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90"
                            href="{{ route('admin.dashboard') }}">
                            Home
                            <svg class="stroke-current rtl:rotate-180" width="17" height="16" viewBox="0 0 17 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90"
                            href="{{ route('admin.products.index') }}">
                            Products
                            <svg class="stroke-current rtl:rotate-180" width="17" height="16" viewBox="0 0 17 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="pageTitle">
                        Edit Product
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    @if ($errors->any())
        <div class="col-span-12 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-800/50 dark:bg-red-900/20">
            <div class="flex items-start gap-3">
                <svg class="mt-0.5 size-5 shrink-0 text-red-600 dark:text-red-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                        clip-rule="evenodd" />
                </svg>
                <div class="flex-1 text-sm text-red-700 dark:text-red-300">
                    <p class="font-medium">Please correct the following errors:</p>
                    <ul class="mt-1.5 list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="col-span-12">
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex flex-wrap items-center justify-between border-b border-gray-100 px-4 py-4 sm:px-6 dark:border-gray-800">
                <div>
                    <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                        Edit Product: {{ $product->name }}
                    </h3>
                    <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                        Update the product information below.
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data"
                class="p-4 sm:p-6"
                x-data="{
                    categoryOptions: @js($categories->map(fn ($category) => [
                        'id' => (string) $category->id,
                        'name' => $category->name,
                        'children' => $category->children->map(fn ($subcategory) => [
                            'id' => (string) $subcategory->id,
                            'name' => $subcategory->name,
                        ])->values(),
                    ])->values()),
                    selectedCategory: @js((string) old('category_id', $product->category_id)),
                    selectedSubcategory: @js((string) old('subcategory_id', $product->subcategory_id ?? '')),
                    get subcategories() {
                        const category = this.categoryOptions.find(item => item.id === this.selectedCategory);
                        return category ? category.children : [];
                    }
                }">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="category_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select id="category_id" name="category_id" required x-model="selectedCategory"
                            @change="selectedSubcategory = ''"
                            class="h-11 w-full rounded-[10px] border @error('category_id') border-red-500 @else border-gray-300 @enderror bg-white px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs outline-hidden focus:border-brand-300 focus:ring-3 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subcategory_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Subcategory
                        </label>
                        <select id="subcategory_id" name="subcategory_id" x-model="selectedSubcategory"
                            :disabled="subcategories.length === 0"
                            class="h-11 w-full rounded-[10px] border @error('subcategory_id') border-red-500 @else border-gray-300 @enderror bg-white px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs outline-hidden focus:border-brand-300 focus:ring-3 focus:ring-brand-500/20 disabled:cursor-not-allowed disabled:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:disabled:bg-gray-800">
                            <option value="">Select a subcategory</option>
                            <template x-for="subcategory in subcategories" :key="subcategory.id">
                                <option :value="subcategory.id" x-text="subcategory.name"></option>
                            </template>
                        </select>
                        @error('subcategory_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Product Name <span class="text-red-500">*</span>
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name', $product->name) }}" required
                            class="h-11 w-full rounded-[10px] border @error('name') border-red-500 @else border-gray-300 @enderror bg-white px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs outline-hidden placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-gray-500">
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Product Image
                        </label>
                        <div class="flex items-center gap-4">
                            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image) }}"
                                alt="{{ $product->name }}" class="size-16 rounded-lg object-cover">
                            <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/webp"
                                class="block min-w-0 flex-1 rounded-[10px] border @error('image') border-red-500 @else border-gray-300 @enderror bg-white px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs file:me-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-gray-700 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:file:bg-gray-800 dark:file:text-gray-300">
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Choose a new image only to replace the current one. JPG, PNG, or WebP, up to 2 MB.</p>
                        @error('image')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full rounded-[10px] border @error('description') border-red-500 @else border-gray-300 @enderror bg-white px-4 py-3 text-sm text-gray-800 shadow-theme-xs outline-hidden placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-gray-500">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="old_price" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Old Price
                        </label>
                        <input id="old_price" type="number" name="old_price" value="{{ old('old_price', $product->old_price) }}"
                            min="0" step="0.01"
                            class="h-11 w-full rounded-[10px] border @error('old_price') border-red-500 @else border-gray-300 @enderror bg-white px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs outline-hidden placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-gray-500">
                        @error('old_price')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_price" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            New Price <span class="text-red-500">*</span>
                        </label>
                        <input id="new_price" type="number" name="new_price" value="{{ old('new_price', $product->new_price) }}"
                            min="0" step="0.01" required
                            class="h-11 w-full rounded-[10px] border @error('new_price') border-red-500 @else border-gray-300 @enderror bg-white px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs outline-hidden placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-gray-500">
                        @error('new_price')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 pt-5 dark:border-gray-800">
                    <a href="{{ route('admin.products.index') }}"
                        class="inline-flex items-center justify-center rounded-[10px] border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-[10px] bg-brand-500 px-5 py-2.5 text-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600 focus:ring-3 focus:ring-brand-500/30">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
