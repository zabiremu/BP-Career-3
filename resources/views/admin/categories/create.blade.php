@extends('admin.layouts.app')

@section('content')
    <div class="col-span-12" x-data="{ pageTitle: 'Create Category' }">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageTitle">
                Create Category
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
                            href="{{ route('admin.category.index') }}">
                            Categories
                            <svg class="stroke-current rtl:rotate-180" width="17" height="16" viewBox="0 0 17 16"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="text-sm font-medium text-gray-800 dark:text-white/90" x-text="pageTitle">
                        Create Category
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    @if ($errors->any())
        <div class="col-span-12 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-800/50 dark:bg-red-900/20">
            <div class="flex items-start gap-3">
                <svg class="size-5 shrink-0 text-red-600 dark:text-red-400 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
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

            <div
                class="flex flex-wrap items-center justify-between border-b border-gray-100 px-4 py-4 sm:px-6 dark:border-gray-800">
                <div>
                    <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                        Category Details
                    </h3>
                    <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                        Fill in the required information to create a new category.
                    </p>
                </div>
                <a href="{{ route('admin.category.index') }}"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-300 bg-white px-3.5 py-2 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                    <svg class="size-4" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Back to List
                </a>
            </div>


            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data"
                class="p-4 sm:p-6">
                @csrf
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Basic Input: Category Name -->
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter category name"
                            required
                            class="h-11 w-full min-w-0 rounded-[10px] border @error('name') border-red-500 focus:border-red-500 focus:ring-red-500/20 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/20 @enderror bg-white px-4 py-2.5 text-sm font-normal text-gray-800 shadow-theme-xs outline-hidden transition-colors placeholder:text-gray-400 focus:ring-3 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-gray-500">
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>


                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Category Slug <span class="text-xs text-gray-400">(Auto-generated if left blank)</span>
                                </label>
                                <input type="text" name="slug" value="{{ old('slug') }}"
                                    placeholder="e.g. electronics-appliances"
                                    class="h-11 w-full min-w-0 rounded-[10px] border @error('slug') border-red-500 focus:border-red-500 focus:ring-red-500/20 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/20 @enderror bg-white px-4 py-2.5 text-sm font-normal text-gray-800 shadow-theme-xs outline-hidden transition-colors placeholder:text-gray-400 focus:ring-3 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-gray-500">
                                @error('slug')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>


                    <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Parent Category
                                </label>
                                <div class="relative">
                                    <select name="parent_id"
                                        class="h-11 w-full min-w-0 appearance-none rounded-[10px] border @error('parent_id') border-red-500 @else border-gray-300 @enderror bg-white py-2.5 ps-4 pe-10 text-sm font-normal text-gray-800 shadow-theme-xs outline-hidden transition-all duration-200 select-none hover:border-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:hover:border-gray-600 dark:focus:border-brand-500/40">
                                        <option value="">None (Root Category)</option>
                                        @foreach ($parentCategories as $parent)
                                            <option value="{{ $parent->id }}"
                                                {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                                {{ $parent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span
                                        class="pointer-events-none absolute inset-e-3.5 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="size-4" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.83325 7.91666L9.99992 12.0833L14.1666 7.91666" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>
                                @error('parent_id')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                    </div>


                                        <div>
                                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                                Status <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <select name="status" required
                                                    class="h-11 w-full min-w-0 appearance-none rounded-[10px] border @error('status') border-red-500 @else border-gray-300 @enderror bg-white py-2.5 ps-4 pe-10 text-sm font-normal text-gray-800 shadow-theme-xs outline-hidden transition-all duration-200 select-none hover:border-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/20 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:hover:border-gray-600 dark:focus:border-brand-500/40">
                                                    <option value="Active" {{ old('status', 'Active') === 'Active' ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="Draft" {{ old('status') === 'Draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="Inactive" {{ old('status') === 'Inactive' ? 'selected' : '' }}>Inactive
                                                    </option>
                                                </select>
                                                <span
                                                    class="pointer-events-none absolute inset-e-3.5 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                                    <svg class="size-4" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.83325 7.91666L9.99992 12.0833L14.1666 7.91666" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            @error('status')
                                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                </div>


                            <div
                                class="mt-8 flex flex-wrap items-center justify-end gap-3 border-t border-gray-100 pt-5 dark:border-gray-800">
                                <a href="{{ route('admin.category.index') }}"
                                    class="inline-flex items-center justify-center rounded-[10px] border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-[10px] bg-brand-500 px-5 py-2.5 text-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600 focus:ring-3 focus:ring-brand-500/30">
                                    Create Category
                                </button>
                            </div>
            </form>
        </div>
    </div>
@endsection
