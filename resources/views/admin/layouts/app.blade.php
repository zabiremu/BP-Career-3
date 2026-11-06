<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        eCommerce Dashboard
    </title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode')) ?? false;
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">
    <!-- ===== Preloader Start ===== -->
    <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 500) })"
        class="fixed top-0 left-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent">
        </div>
    </div>

    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        <!-- This allows screen readers to skip the sidebar and go directly to the main content. -->
        <a class="sr-only" href="#main-content">skip to the main content</a>
        <!-- Sidebar Backdrop (Mobile) -->
        <div x-cloak x-show="sidebarToggle" class="fixed inset-0 z-99 bg-gray-900/50 backdrop-blur-xs xl:hidden"
            aria-hidden="true" @click="sidebarToggle = false" x-transition.opacity></div>

        @include('admin.layouts.partials.sidebar')
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
            <!-- ===== Main Content Start ===== -->
            <main id="main-content">
                <!-- ===== Header Start ===== -->
                <!-- App Header -->
                @include('admin.layouts.partials.header')
                <!-- ===== Header End ===== -->
                <div class="mx-auto max-w-(--breakpoint-2xl) p-4 pb-20 md:p-6 md:pb-6">
                    <div class="grid grid-cols-12 gap-4 md:gap-6">
                        @yield('content')
                    </div>
                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
    <script defer src="{{ asset('js/bundle.js') }}"></script>
</body>

</html>
