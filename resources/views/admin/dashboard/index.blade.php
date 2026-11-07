
@extends('admin.layouts.app')

@section('content')
    <div class="flex flex-col gap-6">

        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                    Dashboard
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Welcome to your admin dashboard.
                </p>
            </div>
        </div>

        <div class="flex flex-row gap-6">

            <div class=" group rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Total Categories
                        </p>
                        <h3 class="mt-3 text-3xl font-bold text-gray-800 dark:text-white">
                            {{ number_format($totalCategories ?? 0) }}
                        </h3>
                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                        <i class="fa-solid fa-layer-group text-2xl"></i>
                    </div>
                </div>
                <div class="mt-5 border-t border-gray-100 pt-4 dark:border-gray-700">
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        Total registered categories
                    </span>
                </div>
            </div>

            <div class="group rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Total Products
                        </p>
                        <h3 class="mt-3 text-3xl font-bold text-gray-800 dark:text-white">
                            {{ number_format($totalProducts ?? 0) }}
                        </h3>
                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-green-100 text-green-600 dark:bg-green-500/10 dark:text-green-400">
                        <i class="fa-solid fa-box-open text-2xl"></i>
                    </div>
                </div>
                <div class="mt-5 border-t border-gray-100 pt-4 dark:border-gray-700">
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        Total available products
                    </span>
                </div>
            </div>

            <div class="group rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Total Orders
                        </p>
                        <h3 class="mt-3 text-3xl font-bold text-gray-800 dark:text-white">
                            {{ number_format($totalOrders ?? 0) }}
                        </h3>
                    </div>

                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-purple-100 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400">
                        <i class="fa-solid fa-cart-shopping text-2xl"></i>
                    </div>
                </div>
                <div class="mt-5 border-t border-gray-100 pt-4 dark:border-gray-700">
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        Total orders received
                    </span>
                </div>
            </div>

        </div>
    </div>
@endsection
