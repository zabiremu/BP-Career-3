@extends('admin.layouts.app')

@section('content')
    <div class="col-span-12" x-data="{ pageTitle: 'Categories' }">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageTitle">
                Categories
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
                    <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageTitle">
                        Categories
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    @if (session('success'))
        <div class="col-span-12 rounded-xl border border-green-200 bg-green-50 p-4 dark:border-green-800/50 dark:bg-green-900/20"
            x-data="{ show: true }" x-show="show">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2 text-sm text-green-700 dark:text-green-300">
                    <svg class="size-5 shrink-0 text-green-600 dark:text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" @click="show = false" class="text-green-600 hover:text-green-800 dark:text-green-400">
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="col-span-12">
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pt-4 pb-3 sm:px-6 dark:border-gray-800 dark:bg-white/3">
            <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Category List
                    </h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Manage your store's product categories and catalog structure.
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.category.create') }}"
                        class="inline-flex items-center gap-1.5 rounded-lg bg-brand-500 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-gray-800">
                        <svg class="size-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                        </svg>
                        Create Category
                    </a>
                </div>
            </div>

            <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">
                    <thead class="border-y border-gray-100 dark:border-gray-800">
                        <tr>
                            <th class="py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400">
                                Category
                            </th>
                            <th class="py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400">
                                Slug
                            </th>
                            <th class="py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400">
                                Parent
                            </th>
                            <th class="py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-400">
                                Status
                            </th>
                            <th class="py-3 text-end text-xs font-medium text-gray-500 dark:text-gray-400">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($categories as $category)
                            <tr>
                                <td class="py-3">
                                    <div class="flex items-center gap-3">

                                        <div>
                                            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                                {{ $category->name }}
                                            </p>
                                            @if ($category->description)
                                                <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1 max-w-xs">
                                                    {{ $category->description }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 text-sm text-gray-500 dark:text-gray-400 font-mono text-xs">
                                    {{ $category->slug }}
                                </td>
                                <td class="py-3 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $category->parent?->name ?? '—' }}
                                </td>
                                <td class="py-3 text-sm">
                                    @if ($category->status === 'Active')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 dark:bg-green-500/15 dark:text-green-400">
                                            <span class="size-1.5 rounded-full bg-green-600 dark:bg-green-400"></span>
                                            Active
                                        </span>
                                    @elseif ($category->status === 'Draft')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700 dark:bg-amber-500/15 dark:text-amber-400">
                                            <span class="size-1.5 rounded-full bg-amber-600 dark:bg-amber-400"></span>
                                            Draft
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-red-700 dark:bg-red-500/15 dark:text-red-400">
                                            <span class="size-1.5 rounded-full bg-red-600 dark:bg-red-400"></span>
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 text-end">
                                    <a href="{{ route('admin.category.edit', $category) }}"
                                        class="text-sm font-medium text-brand-500 hover:text-brand-600 dark:text-brand-400 dark:hover:text-brand-300">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.category.destroy', $category) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this category?');"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No categories found. Click <a href="{{ route('admin.category.create') }}" class="text-brand-500 hover:underline">Create Category</a> to add your first one.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($categories->hasPages())
                <div class="mt-4 border-t border-gray-100 pt-4 dark:border-gray-800">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
