@extends('admin.layouts.app')

@section('content')
    <div class="col-span-12" x-data="{ pageTitle: 'Products' }">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageTitle">
                Products
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
                    <li class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="pageTitle">
                        Products
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    @if (session('success'))
        <div class="col-span-12 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800/50 dark:bg-green-900/20 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="col-span-12">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pt-4 pb-3 sm:px-6 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Product List
                    </h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Manage your products and pricing.
                    </p>
                </div>
                <a href="{{ route('admin.products.create') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-gray-800">
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    Create Product
                </a>
            </div>

            <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">
                    <thead class="border-y border-gray-100 dark:border-gray-800">
                        <tr>
                            <th class="py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400">Product</th>
                            <th class="py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400">Category</th>
                            <th class="py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400">Subcategory</th>
                            <th class="py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400">Old Price</th>
                            <th class="py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400">New Price</th>
                            <th class="py-3 text-end text-xs font-medium text-gray-500 dark:text-gray-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($products as $product)
                            <tr>
                                <td class="py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($product->image) }}"
                                            alt="{{ $product->name }}" class="size-12 rounded-lg object-cover">
                                        <div>
                                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                                {{ $product->name }}
                                            </p>
                                            @if ($product->description)
                                                <p class="max-w-xs text-xs text-gray-500 line-clamp-2 dark:text-gray-400">
                                                    {{ $product->description }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $product->category->name }}
                                </td>
                                <td class="py-3 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $product->subcategory?->name ?? '—' }}
                                </td>
                                <td class="py-3 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $product->old_price !== null ? number_format((float) $product->old_price, 2) : '—' }}
                                </td>
                                <td class="py-3 text-sm font-medium text-gray-800 dark:text-white/90">
                                    {{ number_format((float) $product->new_price, 2) }}
                                </td>
                                <td class="py-3 text-end">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="text-sm font-medium text-brand-500 hover:text-brand-600 dark:text-brand-400 dark:hover:text-brand-300">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');"
                                        class="ms-2 inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-sm font-medium text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No products found. <a href="{{ route('admin.products.create') }}"
                                        class="text-brand-500 hover:underline">Create your first product</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($products->hasPages())
                <div class="mt-4 border-t border-gray-100 pt-4 dark:border-gray-800">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
