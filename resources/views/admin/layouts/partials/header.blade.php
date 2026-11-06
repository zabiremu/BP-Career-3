<header x-data="{ isApplicationMenuOpen: false }"
    @keydown.window="(e) => { if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') { e.preventDefault(); $refs.searchInput?.focus(); } }"
    class="sticky top-0 z-50 flex w-full shrink-0 border-gray-200 bg-white xl:border-b dark:border-gray-800 dark:bg-gray-900">
    <div class="flex grow flex-col items-center justify-between xl:flex-row xl:px-6">
        <!-- Left side content -->
        <div
            class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 xl:justify-normal xl:border-b-0 xl:px-0 xl:py-4 dark:border-gray-800">
            <!-- Sidebar Toggle Button -->
            <button type="button" @click.stop="sidebarToggle = !sidebarToggle" :aria-label="$t('header.toggleSidebar')"
                aria-label="Toggle Sidebar"
                class="group/button relative inline-flex size-10 shrink-0 items-center justify-center rounded-[10px] border border-gray-300 bg-transparent text-gray-500 shadow-theme-xs transition-all select-none hover:bg-gray-50 hover:text-gray-800 focus-visible:ring-3 focus-visible:ring-gray-300/50 focus-visible:outline-hidden active:translate-y-px lg:size-11 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700/50 dark:hover:text-white">
                <!-- XIcon (shown when mobile sidebar is open) -->
                <svg x-show="sidebarToggle && window.innerWidth < 1280" class="size-6" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18M6 6l12 12" />
                </svg>

                <!-- MenuTwoIcon (shown by default / desktop) -->
                <svg x-show="!sidebarToggle || window.innerWidth >= 1280" class="size-auto! rtl:-scale-x-100"
                    width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.583252 1C0.583252 0.585788 0.919038 0.25 1.33325 0.25H14.6666C15.0808 0.25 15.4166 0.585786 15.4166 1C15.4166 1.41421 15.0808 1.75 14.6666 1.75L1.33325 1.75C0.919038 1.75 0.583252 1.41422 0.583252 1ZM0.583252 11C0.583252 10.5858 0.919038 10.25 1.33325 10.25L14.6666 10.25C15.0808 10.25 15.4166 10.5858 15.4166 11C15.4166 11.4142 15.0808 11.75 14.6666 11.75L1.33325 11.75C0.919038 11.75 0.583252 11.4142 0.583252 11ZM1.33325 5.25C0.919038 5.25 0.583252 5.58579 0.583252 6C0.583252 6.41421 0.919038 6.75 1.33325 6.75L7.99992 6.75C8.41413 6.75 8.74992 6.41421 8.74992 6C8.74992 5.58579 8.41413 5.25 7.99992 5.25L1.33325 5.25Z"
                        fill="currentColor" />
                </svg>
            </button>

            <!-- Mobile Logo -->
            <a href="index.html" class="xl:hidden">
                <img class="h-8 w-38.5 dark:hidden" src="{{ asset('images/logo/logo.svg') }}" alt="Logo" />
                <img class="hidden h-8 w-38.5 dark:block" src="{{ asset('images/logo/logo-dark.svg') }}" alt="Logo" />
            </a>

            <!-- Mobile Application Menu Toggle Button -->
            <button type="button" @click="isApplicationMenuOpen = !isApplicationMenuOpen"
                aria-label="Toggle application menu"
                class="inline-flex size-10 shrink-0 items-center justify-center rounded-[10px] border-none bg-transparent text-gray-700 transition-all select-none hover:bg-gray-50 hover:text-gray-800 focus-visible:ring-3 focus-visible:ring-gray-300/50 focus-visible:outline-hidden xl:hidden dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700/50 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="1" />
                    <circle cx="19" cy="12" r="1" />
                    <circle cx="5" cy="12" r="1" />
                </svg>
            </button>

            <!-- Search Input (Desktop) -->
            <div class="hidden xl:block">
                <form @submit.prevent>
                    <div class="xl:w-107.5">
                        <div data-slot="input-group" role="group"
                            class="group/input-group relative flex h-11 w-full min-w-0 items-center rounded-[10px] border border-gray-200 bg-transparent shadow-theme-xs outline-hidden transition-colors has-[[data-slot=input-group-control]:focus]:border-brand-300 has-[[data-slot=input-group-control]:focus]:ring-3 has-[[data-slot=input-group-control]:focus]:ring-brand-500/20 has-[[data-slot=input-group-control]:focus-visible]:border-brand-300 has-[[data-slot=input-group-control]:focus-visible]:ring-3 has-[[data-slot=input-group-control]:focus-visible]:ring-brand-500/20 dark:border-gray-800 dark:bg-white/3 dark:has-[[data-slot=input-group-control]:focus]:border-brand-500/40 dark:has-[[data-slot=input-group-control]:focus-visible]:border-brand-500/40">
                            <div role="group" data-slot="input-group-addon" data-align="inline-start"
                                class="flex h-auto cursor-text items-center justify-center gap-2 py-1.5 ps-3.5 text-sm font-medium text-gray-500 select-none dark:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none" class="size-5 text-gray-500 dark:text-gray-400">
                                    <path
                                        d="M14.382 14.383l3.325 3.326m-1.249-8.334a7.082 7.082 0 01-7.083 7.081 7.082 7.082 0 110-14.163 7.082 7.082 0 017.083 7.082z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>

                            <input x-ref="searchInput" data-slot="input-group-control" type="text"
                                :placeholder="$t('header.searchPlaceholder')" placeholder="Search or type command..."
                                class="h-full flex-1 rounded-none border-0 bg-transparent px-2 text-sm text-gray-800 shadow-none ring-0 outline-hidden placeholder:text-gray-400 focus:border-transparent focus:ring-0 focus:outline-hidden focus-visible:border-transparent focus-visible:ring-0 dark:text-white/90 dark:placeholder:text-white/30" />

                            <div role="group" data-slot="input-group-addon" data-align="inline-end"
                                class="flex h-auto cursor-text items-center justify-center gap-2 py-1.5 pe-3.5 text-sm font-medium text-gray-500 select-none dark:text-gray-400">
                                <span data-slot="badge" data-variant="light" data-color="gray" data-size="sm"
                                    @click="$refs.searchInput.focus()"
                                    class="group/badge inline-flex h-5.5 w-fit shrink-0 cursor-pointer items-center justify-center gap-0.5 rounded-lg border border-gray-200 bg-gray-50 px-1.75 py-[4.5px] text-xs font-medium tracking-[-0.2px] whitespace-nowrap text-gray-500 shadow-none transition-colors select-none [text-shadow:0_4px_4px_var(--color-gray-300)] dark:border-gray-800 dark:bg-white/3 dark:text-gray-400 dark:[text-shadow:0_4px_4px_rgba(255,255,255,0.10)] [&:has(>svg:first-child)]:ps-1.5 [&:has(>svg:last-child)]:pe-1.5 [&>svg]:pointer-events-none [&>svg]:size-3 [&>svg]:shrink-0">
                                    <span>⌘</span>
                                    <span>K</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right side content -->
        <div class="w-full items-center justify-between gap-4 px-5 py-4 shadow-theme-md xl:flex xl:justify-end xl:px-0 xl:shadow-none"
            :class="isApplicationMenuOpen ? 'flex' : 'hidden'">
            <div class="flex items-center gap-2 2xsm:gap-3">
                <!-- Theme Toggler -->
                <!-- Theme Toggle Button -->
                <button type="button"
                    @click.prevent="darkMode = !darkMode; document.documentElement.classList.toggle('dark', darkMode); localStorage.setItem('darkMode', JSON.stringify(darkMode))"
                    class="relative inline-flex size-11 shrink-0 items-center justify-center rounded-[10px] border border-gray-300 bg-transparent text-gray-700 shadow-theme-xs transition-all select-none hover:bg-gray-50 hover:text-gray-800 focus-visible:ring-3 focus-visible:ring-gray-300/50 focus-visible:outline-hidden active:translate-y-px dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700/50 dark:hover:text-white"
                    aria-label="Toggle theme">
                    <!-- Sun Icon (Dark Mode) -->
                    <svg x-cloak x-show="darkMode" class="size-auto!" xmlns="http://www.w3.org/2000/svg" width="20"
                        height="20" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.5" />
                        <path
                            d="M12 2v2m0 16v2M4.22 4.22l1.42 1.42m12.72 12.72l1.42 1.42M2 12h2m16 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>

                    <!-- Moon Icon (Light Mode) -->
                    <svg x-cloak x-show="!darkMode" class="size-auto!" xmlns="http://www.w3.org/2000/svg"
                        width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M6.247 6.668a6.668 6.668 0 0011.207 4.885A7.708 7.708 0 118.03 2.129a6.645 6.645 0 00-1.783 4.54z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <!-- Notification Dropdown -->
                <!-- Notification Dropdown -->
                <div class="relative" x-data="dropdown({ placement: 'bottom-end', offset: 8, notifying: true })" @click.outside="open = false"
                    @keydown.escape.window="open = false">
                    <!-- Trigger Button -->
                    <button x-ref="trigger" type="button" @click="toggle(); if (open) notifying = false"
                        class="relative inline-flex size-11 shrink-0 items-center justify-center rounded-[10px] border border-gray-300 bg-transparent text-gray-700 shadow-theme-xs transition-all select-none hover:bg-gray-50 hover:text-gray-800 focus-visible:ring-3 focus-visible:ring-gray-300/50 focus-visible:outline-hidden active:translate-y-px dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700/50 dark:hover:text-white"
                        aria-label="Toggle notifications">
                        <!-- Ping Indicator Dot -->
                        <span
                            class="absolute inset-e-0 -top-0.5 z-10 h-2 w-2 translate-x-1/2 rounded-full bg-orange-400 rtl:-inset-e-1.5"
                            :class="!notifying ? 'hidden' : 'flex'">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-orange-400 opacity-75"></span>
                        </span>

                        <!-- Bell Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none" class="size-auto!">
                            <path
                                d="M9.861 1.876v1.25m0 0a5.625 5.625 0 015.625 5.625v6.041H4.236V8.751a5.625 5.625 0 015.625-5.625zm-1.25 14.166h2.5m-7.917-2.5h13.334"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu Content -->
                    <div x-ref="dropdown" x-cloak x-show="open"
                        x-transition:enter="animate-in fade-in-0 zoom-in-95 duration-100"
                        x-transition:leave="animate-out fade-out-0 zoom-out-95 fill-mode-forwards duration-75"
                        class="fixed z-50 flex w-87.5 max-w-[calc(100vw-1rem)] flex-col gap-1 overflow-hidden rounded-2xl border border-gray-200 bg-white p-3 shadow-theme-lg outline-none sm:w-90.25 dark:border-gray-800 dark:bg-[#1E2635]">
                        <!-- Dropdown Header -->
                        <div class="flex items-center justify-between pb-3">
                            <h5 class="text-title-sm font-semibold text-gray-800 dark:text-gray-200"
                                x-text="$t('header.notifications.title')">
                                Notification
                            </h5>
                            <button type="button" @click="open = false"
                                class="inline-flex size-8 shrink-0 items-center justify-center rounded-lg border-none bg-transparent text-gray-700 transition-all hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700/50 dark:hover:text-white"
                                aria-label="Close notifications">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="size-5">
                                    <path d="M18 6L6 18M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="-mx-3 my-0 h-px bg-gray-100 dark:bg-gray-700"></div>

                        <!-- Notification List (ScrollArea) -->
                        <div class="flex custom-scrollbar h-96 flex-col overflow-y-auto pe-2">
                            <!-- Item 1 -->
                            <a href="javascript:void(0)"
                                class="group/dropdown-menu-item flex items-start gap-3 rounded-lg p-3 hover:bg-gray-100 dark:hover:bg-white/5">
                                <div class="relative flex size-10 shrink-0 select-none">
                                    <img src="{{ asset('images/user/user-02.jpg') }}" alt="Terry Franci"
                                        class="aspect-square size-full rounded-full object-cover" />
                                    <span
                                        class="absolute top-0 right-0 z-10 size-2.5 rounded-full bg-green-500 ring-2 ring-white select-none dark:ring-black"></span>
                                </div>
                                <span class="block flex-1 text-start">
                                    <span class="mb-1.5 block space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-medium text-gray-800 dark:text-white/90">Terry
                                            Franci</span>
                                        <span x-text="$t('header.notifications.requestsPermission')">requests
                                            permission to change</span>
                                        <span class="font-medium text-gray-800 dark:text-white/90">Project
                                            - Nganter App</span>
                                    </span>
                                    <span class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span x-text="$t('header.notifications.project')">Project</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="size-2 text-gray-400 dark:text-gray-500">
                                            <circle cx="12" cy="12" r="1" />
                                        </svg>
                                        <span x-text="$t('header.notifications.minAgo', { count: 5 })">5
                                            min ago</span>
                                    </span>
                                </span>
                            </a>
                            <div class="my-0.5 h-px bg-gray-100 last-of-type:hidden dark:bg-gray-700">
                            </div>

                            <!-- Item 2 -->
                            <a href="javascript:void(0)"
                                class="group/dropdown-menu-item flex items-start gap-3 rounded-lg p-3 hover:bg-gray-100 dark:hover:bg-white/5">
                                <div class="relative flex size-10 shrink-0 select-none">
                                    <img src="{{ asset('images/user/user-03.jpg') }}" alt="Alena Franci"
                                        class="aspect-square size-full rounded-full object-cover" />
                                    <span
                                        class="absolute top-0 right-0 z-10 size-2.5 rounded-full bg-green-500 ring-2 ring-white select-none dark:ring-black"></span>
                                </div>
                                <span class="block flex-1 text-start">
                                    <span class="mb-1.5 block space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-medium text-gray-800 dark:text-white/90">Alena
                                            Franci</span>
                                        <span x-text="$t('header.notifications.requestsPermission')">requests
                                            permission to change</span>
                                        <span class="font-medium text-gray-800 dark:text-white/90">Project
                                            - Nganter App</span>
                                    </span>
                                    <span class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span x-text="$t('header.notifications.project')">Project</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="size-2 text-gray-400 dark:text-gray-500">
                                            <circle cx="12" cy="12" r="1" />
                                        </svg>
                                        <span x-text="$t('header.notifications.minAgo', { count: 8 })">8
                                            min ago</span>
                                    </span>
                                </span>
                            </a>
                            <div class="my-0.5 h-px bg-gray-100 last-of-type:hidden dark:bg-gray-700">
                            </div>

                            <!-- Item 3 -->
                            <a href="javascript:void(0)"
                                class="group/dropdown-menu-item flex items-start gap-3 rounded-lg p-3 hover:bg-gray-100 dark:hover:bg-white/5">
                                <div class="relative flex size-10 shrink-0 select-none">
                                    <img src="{{ asset('images/user/user-04.jpg') }}" alt="Jocelyn Kenter"
                                        class="aspect-square size-full rounded-full object-cover" />
                                    <span
                                        class="absolute top-0 right-0 z-10 size-2.5 rounded-full bg-green-500 ring-2 ring-white select-none dark:ring-black"></span>
                                </div>
                                <span class="block flex-1 text-start">
                                    <span class="mb-1.5 block space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-medium text-gray-800 dark:text-white/90">Jocelyn
                                            Kenter</span>
                                        <span x-text="$t('header.notifications.requestsPermission')">requests
                                            permission to change</span>
                                        <span class="font-medium text-gray-800 dark:text-white/90">Project
                                            - Nganter App</span>
                                    </span>
                                    <span class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span x-text="$t('header.notifications.project')">Project</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="size-2 text-gray-400 dark:text-gray-500">
                                            <circle cx="12" cy="12" r="1" />
                                        </svg>
                                        <span x-text="$t('header.notifications.minAgo', { count: 15 })">15
                                            min ago</span>
                                    </span>
                                </span>
                            </a>
                            <div class="my-0.5 h-px bg-gray-100 last-of-type:hidden dark:bg-gray-700">
                            </div>

                            <!-- Item 4 -->
                            <a href="javascript:void(0)"
                                class="group/dropdown-menu-item flex items-start gap-3 rounded-lg p-3 hover:bg-gray-100 dark:hover:bg-white/5">
                                <div class="relative flex size-10 shrink-0 select-none">
                                    <img src="{{ asset('images/user/user-05.jpg') }}" alt="Brandon Philips"
                                        class="aspect-square size-full rounded-full object-cover" />
                                    <span
                                        class="absolute top-0 right-0 z-10 size-2.5 rounded-full bg-red-500 ring-2 ring-white select-none dark:ring-black"></span>
                                </div>
                                <span class="block flex-1 text-start">
                                    <span class="mb-1.5 block space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-medium text-gray-800 dark:text-white/90">Brandon
                                            Philips</span>
                                        <span x-text="$t('header.notifications.requestsPermission')">requests
                                            permission to change</span>
                                        <span class="font-medium text-gray-800 dark:text-white/90">Project
                                            - Nganter App</span>
                                    </span>
                                    <span class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span x-text="$t('header.notifications.project')">Project</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="size-2 text-gray-400 dark:text-gray-500">
                                            <circle cx="12" cy="12" r="1" />
                                        </svg>
                                        <span x-text="$t('header.notifications.hrAgo', { count: 1 })">1
                                            hr ago</span>
                                    </span>
                                </span>
                            </a>
                            <div class="my-0.5 h-px bg-gray-100 last-of-type:hidden dark:bg-gray-700">
                            </div>

                            <!-- Item 5 -->
                            <a href="javascript:void(0)"
                                class="group/dropdown-menu-item flex items-start gap-3 rounded-lg p-3 hover:bg-gray-100 dark:hover:bg-white/5">
                                <div class="relative flex size-10 shrink-0 select-none">
                                    <img src="{{ asset('images/user/user-02.jpg') }}" alt="Terry Franci"
                                        class="aspect-square size-full rounded-full object-cover" />
                                    <span
                                        class="absolute top-0 right-0 z-10 size-2.5 rounded-full bg-green-500 ring-2 ring-white select-none dark:ring-black"></span>
                                </div>
                                <span class="block flex-1 text-start">
                                    <span class="mb-1.5 block space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-medium text-gray-800 dark:text-white/90">Terry
                                            Franci</span>
                                        <span x-text="$t('header.notifications.requestsPermission')">requests
                                            permission to change</span>
                                        <span class="font-medium text-gray-800 dark:text-white/90">Project
                                            - Nganter App</span>
                                    </span>
                                    <span class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span x-text="$t('header.notifications.project')">Project</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="size-2 text-gray-400 dark:text-gray-500">
                                            <circle cx="12" cy="12" r="1" />
                                        </svg>
                                        <span x-text="$t('header.notifications.minAgo', { count: 5 })">5
                                            min ago</span>
                                    </span>
                                </span>
                            </a>
                            <div class="my-0.5 h-px bg-gray-100 last-of-type:hidden dark:bg-gray-700">
                            </div>

                            <!-- Item 6 -->
                            <a href="javascript:void(0)"
                                class="group/dropdown-menu-item flex items-start gap-3 rounded-lg p-3 hover:bg-gray-100 dark:hover:bg-white/5">
                                <div class="relative flex size-10 shrink-0 select-none">
                                    <img src="{{ asset('images/user/user-03.jpg') }}" alt="Alena Franci"
                                        class="aspect-square size-full rounded-full object-cover" />
                                    <span
                                        class="absolute top-0 right-0 z-10 size-2.5 rounded-full bg-green-500 ring-2 ring-white select-none dark:ring-black"></span>
                                </div>
                                <span class="block flex-1 text-start">
                                    <span class="mb-1.5 block space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-medium text-gray-800 dark:text-white/90">Alena
                                            Franci</span>
                                        <span x-text="$t('header.notifications.requestsPermission')">requests
                                            permission to change</span>
                                        <span class="font-medium text-gray-800 dark:text-white/90">Project
                                            - Nganter App</span>
                                    </span>
                                    <span class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span x-text="$t('header.notifications.project')">Project</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="size-2 text-gray-400 dark:text-gray-500">
                                            <circle cx="12" cy="12" r="1" />
                                        </svg>
                                        <span x-text="$t('header.notifications.minAgo', { count: 8 })">8
                                            min ago</span>
                                    </span>
                                </span>
                            </a>
                            <div class="my-0.5 h-px bg-gray-100 last-of-type:hidden dark:bg-gray-700">
                            </div>

                            <!-- Item 7 -->
                            <a href="javascript:void(0)"
                                class="group/dropdown-menu-item flex items-start gap-3 rounded-lg p-3 hover:bg-gray-100 dark:hover:bg-white/5">
                                <div class="relative flex size-10 shrink-0 select-none">
                                    <img src="{{ asset('images/user/user-04.jpg') }}" alt="Jocelyn Kenter"
                                        class="aspect-square size-full rounded-full object-cover" />
                                    <span
                                        class="absolute top-0 right-0 z-10 size-2.5 rounded-full bg-green-500 ring-2 ring-white select-none dark:ring-black"></span>
                                </div>
                                <span class="block flex-1 text-start">
                                    <span class="mb-1.5 block space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-medium text-gray-800 dark:text-white/90">Jocelyn
                                            Kenter</span>
                                        <span x-text="$t('header.notifications.requestsPermission')">requests
                                            permission to change</span>
                                        <span class="font-medium text-gray-800 dark:text-white/90">Project
                                            - Nganter App</span>
                                    </span>
                                    <span class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span x-text="$t('header.notifications.project')">Project</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="size-2 text-gray-400 dark:text-gray-500">
                                            <circle cx="12" cy="12" r="1" />
                                        </svg>
                                        <span x-text="$t('header.notifications.minAgo', { count: 15 })">15
                                            min ago</span>
                                    </span>
                                </span>
                            </a>
                            <div class="my-0.5 h-px bg-gray-100 last-of-type:hidden dark:bg-gray-700">
                            </div>

                            <!-- Item 8 -->
                            <a href="javascript:void(0)"
                                class="group/dropdown-menu-item flex items-start gap-3 rounded-lg p-3 hover:bg-gray-100 dark:hover:bg-white/5">
                                <div class="relative flex size-10 shrink-0 select-none">
                                    <img src="{{ asset('images/user/user-05.jpg') }}" alt="Brandon Philips"
                                        class="aspect-square size-full rounded-full object-cover" />
                                    <span
                                        class="absolute top-0 right-0 z-10 size-2.5 rounded-full bg-red-500 ring-2 ring-white select-none dark:ring-black"></span>
                                </div>
                                <span class="block flex-1 text-start">
                                    <span class="mb-1.5 block space-x-1 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="font-medium text-gray-800 dark:text-white/90">Brandon
                                            Philips</span>
                                        <span x-text="$t('header.notifications.requestsPermission')">requests
                                            permission to change</span>
                                        <span class="font-medium text-gray-800 dark:text-white/90">Project
                                            - Nganter App</span>
                                    </span>
                                    <span class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span x-text="$t('header.notifications.project')">Project</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="size-2 text-gray-400 dark:text-gray-500">
                                            <circle cx="12" cy="12" r="1" />
                                        </svg>
                                        <span x-text="$t('header.notifications.hrAgo', { count: 1 })">1
                                            hr ago</span>
                                    </span>
                                </span>
                            </a>
                        </div>

                        <!-- View All Notifications Button -->
                        <a href="index.html" @click="isOpen = false"
                            class="mt-3 inline-flex h-10 w-full items-center justify-center rounded-[10px] border border-gray-300 bg-transparent px-4 py-2.5 text-sm font-medium text-gray-700 shadow-theme-xs transition-all select-none hover:bg-gray-50 hover:text-gray-800 focus-visible:ring-3 focus-visible:ring-gray-300/50 focus-visible:outline-hidden active:translate-y-px dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700/50 dark:hover:text-white"
                            x-text="$t('header.notifications.viewAll')">
                            View All Notifications
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Dropdown -->
            <!-- User Dropdown -->
            <div class="relative" x-data="dropdown({
                placement: 'bottom-end',
                offset: 8,
                subPlacement: 'left-start',
                subOffset: 4,

                getMainItems() {
                    return Array.from(this.$refs.menu?.querySelectorAll('[role=menuitem]:not([data-submenu-item])') || []);
                },

                openMenu(focusFirst = true) {
                    this.open = true;
                    this.subOpen = false;
                    this.$nextTick(() => {
                        const items = this.getMainItems();
                        if (items.length) {
                            (focusFirst ? items[0] : items[items.length - 1]).focus();
                        }
                    });
                },

                closeMenu(returnFocus = true) {
                    if (!this.open) return;
                    this.open = false;
                    this.subOpen = false;
                    if (returnFocus) {
                        this.$nextTick(() => this.$refs.trigger?.focus());
                    }
                },

                toggleMenu() {
                    if (this.open) {
                        this.closeMenu(false);
                    } else {
                        this.openMenu(true);
                    }
                },

                navigate(e) {
                    const items = this.getMainItems();
                    const index = items.indexOf(document.activeElement);
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        const next = index < items.length - 1 ? index + 1 : 0;
                        items[next]?.focus();
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        const prev = index > 0 ? index - 1 : items.length - 1;
                        items[prev]?.focus();
                    } else if (e.key === 'Home') {
                        e.preventDefault();
                        items[0]?.focus();
                    } else if (e.key === 'End') {
                        e.preventDefault();
                        items[items.length - 1]?.focus();
                    }
                },

                openSubmenu() {
                    this.subOpen = true;
                    this.$nextTick(() => {
                        const subItems = Array.from(this.$refs.submenu?.querySelectorAll('[role=menuitem]') || []);
                        if (subItems.length) subItems[0].focus();
                    });
                },

                closeSubmenu() {
                    this.subOpen = false;
                    this.$nextTick(() => this.$refs.subTrigger?.focus());
                },

                navigateSub(e) {
                    const subItems = Array.from(this.$refs.submenu?.querySelectorAll('[role=menuitem]') || []);
                    const index = subItems.indexOf(document.activeElement);
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        const next = index < subItems.length - 1 ? index + 1 : 0;
                        subItems[next]?.focus();
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        const prev = index > 0 ? index - 1 : subItems.length - 1;
                        subItems[prev]?.focus();
                    } else if (e.key === 'Home') {
                        e.preventDefault();
                        subItems[0]?.focus();
                    } else if (e.key === 'End') {
                        e.preventDefault();
                        subItems[subItems.length - 1]?.focus();
                    }
                }
            })" @click.outside="closeMenu(false)"
                @keydown.escape.window="closeMenu(true)">
                <!-- Trigger Button -->
                <button type="button" x-ref="trigger" id="user-menu-button" aria-haspopup="menu"
                    :aria-expanded="open.toString()" aria-controls="user-menu" aria-label="User menu"
                    @click="toggleMenu()" @keydown.down.prevent="openMenu(true)"
                    @keydown.up.prevent="openMenu(false)"
                    class="dropdown-toggle flex items-center text-gray-700 dark:text-gray-400">
                    <span class="me-3 h-11 w-11 overflow-hidden rounded-lg">
                        <img src="{{ asset('images/user/owner.png') }}" alt="User" class="size-11" />
                    </span>

                    <span class="me-1 block text-sm font-medium">Musharof</span>

                    <svg class="size-5 text-gray-500 transition-transform duration-200 dark:text-gray-400"
                        :class="open ? 'rotate-180' : 'rotate-0'" width="20" height="20" viewBox="0 0 20 20"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.792 7.396L10 12.604l5.208-5.208" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>

                <!-- Dropdown Menu Content -->
                <div x-cloak x-show="open" x-ref="menu" id="user-menu" role="menu"
                    aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                    @keydown.tab="open = false; subOpen = false" @keydown.escape.stop="closeMenu(true)"
                    @keydown="navigate($event)" x-transition:enter="animate-in fade-in-0 zoom-in-95 duration-100"
                    x-transition:leave="animate-out fade-out-0 zoom-out-95 fill-mode-forwards duration-75"
                    class="fixed z-50 flex w-65 flex-col gap-1 rounded-2xl border border-gray-200 bg-white p-3 shadow-theme-lg outline-none dark:border-gray-800 dark:bg-[#1E2635]">
                    <!-- User Info Header -->
                    <div class="px-3 py-2">
                        <span class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Musharof Chowdhury
                        </span>
                        <span class="mt-0.5 block text-xs text-gray-500 dark:text-gray-400">
                            randomuser@pimjo.com
                        </span>
                    </div>

                    <div class="-mx-3 my-1.5 h-px bg-gray-100 dark:bg-gray-700"></div>

                    <!-- Edit Profile -->
                    <a href="profile.html" role="menuitem" tabindex="-1"
                        class="group/dropdown-menu-item relative flex cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 outline-hidden transition-colors duration-200 select-none hover:bg-gray-100 hover:text-gray-700 focus:bg-gray-100 focus:text-gray-700 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-gray-300 dark:focus:bg-white/5 dark:focus:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none"
                            class="size-6 text-gray-500 group-hover/dropdown-menu-item:text-gray-700 dark:text-gray-400 dark:group-hover/dropdown-menu-item:text-gray-300">
                            <path
                                d="M17.775 19.107v-.261a4.5 4.5 0 00-4.5-4.5h-2.55a4.5 4.5 0 00-4.5 4.5v.261M21.25 12a9.25 9.25 0 11-18.5 0 9.25 9.25 0 0118.5 0zm-6.483-2.732a2.768 2.768 0 11-5.536 0 2.768 2.768 0 015.536 0z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span x-text="$t('userDropdown.editProfile')">Edit profile</span>
                    </a>

                    <!-- Account Settings -->
                    <a href="profile.html" role="menuitem" tabindex="-1"
                        class="group/dropdown-menu-item relative flex cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 outline-hidden transition-colors duration-200 select-none hover:bg-gray-100 hover:text-gray-700 focus:bg-gray-100 focus:text-gray-700 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-gray-300 dark:focus:bg-white/5 dark:focus:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none"
                            class="size-6 text-gray-500 group-hover/dropdown-menu-item:text-gray-700 dark:text-gray-400 dark:group-hover/dropdown-menu-item:text-gray-300">
                            <path
                                d="M6.775 5.52a1.484 1.484 0 00-2.028.542L3.231 8.688c-.41.71-.166 1.617.543 2.027.99.571.99 1.999 0 2.57a1.484 1.484 0 00-.543 2.027l1.516 2.626c.41.71 1.318.953 2.028.543A1.484 1.484 0 019 19.766c0 .82.664 1.484 1.484 1.484h3.032c.82 0 1.484-.664 1.484-1.484a1.484 1.484 0 012.225-1.285c.71.41 1.617.167 2.027-.543l1.516-2.626c.41-.71.167-1.617-.543-2.027a1.484 1.484 0 010-2.57c.71-.41.953-1.317.543-2.027l-1.516-2.626a1.484 1.484 0 00-2.027-.543 1.483 1.483 0 01-2.225-1.285c0-.82-.664-1.484-1.484-1.484h-3.032c-.82 0-1.484.664-1.484 1.484a1.484 1.484 0 01-2.226 1.285z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M15.085 12a3.085 3.085 0 11-6.17 0 3.085 3.085 0 016.17 0z" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span x-text="$t('userDropdown.accountSettings')">Account settings</span>
                    </a>

                    <!-- Support -->
                    <a href="profile.html" role="menuitem" tabindex="-1"
                        class="group/dropdown-menu-item relative flex cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 outline-hidden transition-colors duration-200 select-none hover:bg-gray-100 hover:text-gray-700 focus:bg-gray-100 focus:text-gray-700 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-gray-300 dark:focus:bg-white/5 dark:focus:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none"
                            class="size-6 text-gray-500 group-hover/dropdown-menu-item:text-gray-700 dark:text-gray-400 dark:group-hover/dropdown-menu-item:text-gray-300">
                            <path d="M12 8.67h0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 11.215v4.224M21.25 12a9.25 9.25 0 11-18.5 0 9.25 9.25 0 0118.5 0z"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span x-text="$t('userDropdown.support')">Support</span>
                    </a>

                    <!-- Submenu: Language -->
                    <div class="relative" @mouseenter="subOpen = true" @mouseleave="subOpen = false">
                        <button type="button" x-ref="subTrigger" id="language-menu-button" role="menuitem"
                            aria-haspopup="menu" :aria-expanded="subOpen.toString()" aria-controls="language-submenu"
                            tabindex="-1" @click="subOpen = !subOpen" @keydown.right.prevent="openSubmenu()"
                            @keydown.enter.prevent="openSubmenu()"
                            class="group/dropdown-menu-sub-trigger relative flex w-full cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 outline-hidden transition-colors duration-200 select-none hover:bg-gray-100 hover:text-gray-700 focus:bg-gray-100 focus:text-gray-700 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-gray-300 dark:focus:bg-white/5 dark:focus:text-gray-300"
                            :class="{ 'bg-gray-100 dark:bg-white/5': subOpen }">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none"
                                class="size-6 text-gray-500 group-hover/dropdown-menu-sub-trigger:text-gray-700 dark:text-gray-400 dark:group-hover/dropdown-menu-sub-trigger:text-gray-300">
                                <path
                                    d="M12.001 2.75a9.25 9.25 0 019.25 9.25A9.25 9.25 0 0112 21.25m0-18.5A9.25 9.25 0 002.751 12a9.25 9.25 0 009.25 9.25m0-18.5c2.209 0 4 4.141 4 9.25 0 5.107-1.791 9.25-4 9.25m0-18.5c-2.209 0-3.999 4.141-3.999 9.25 0 5.107 1.79 9.25 3.999 9.25M3.246 9h17.508M3.246 15h17.508"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>

                            <span class="text-gray-700 dark:text-gray-300"
                                x-text="$t('userDropdown.language')">Language</span>

                            <!-- Current Language Badge -->
                            <span
                                class="ms-auto me-1 inline-flex h-auto items-center gap-1.5 rounded-md border border-gray-200 bg-gray-50 px-2 py-1 text-xs font-medium text-gray-700 dark:border-gray-800 dark:bg-white/3 dark:text-gray-300">
                                <span
                                    x-text="$store.i18n && $store.i18n.currentLocale ? $store.i18n.currentLocale.toUpperCase() : 'EN'">EN</span>
                                <img :src="$store.i18n && $store.i18n.currentLang ? $store.i18n.currentLang.flag :
                                    '{{ asset('images/flag/flag-us.svg') }}'"
                                    :alt="$store.i18n && $store.i18n.currentLang ? $store.i18n.currentLang
                                        .name : 'Flag'"
                                    class="size-3.5 shrink-0 overflow-hidden rounded-full" />
                            </span>
                        </button>

                        <!-- Nested Submenu Content (opens to left of dropdown in LTR, right in RTL) -->
                        <div x-cloak x-show="subOpen" x-ref="submenu" id="language-submenu" role="menu"
                            aria-orientation="vertical" aria-labelledby="language-menu-button" tabindex="-1"
                            @keydown.tab="open = false; subOpen = false" @keydown.left.prevent="closeSubmenu()"
                            @keydown.escape.stop="closeSubmenu()" @keydown="navigateSub($event)"
                            x-transition:enter="animate-in fade-in-0 zoom-in-95 duration-100"
                            x-transition:leave="animate-out fade-out-0 zoom-out-95 fill-mode-forwards duration-75"
                            class="fixed z-50 flex w-56 flex-col gap-1 rounded-2xl border border-gray-200 bg-white p-2 shadow-theme-lg outline-none dark:border-gray-800 dark:bg-[#1E2635]">
                            <template x-for="language in ($store.i18n ? $store.i18n.locales : [])"
                                :key="language.code">
                                <button type="button" role="menuitem" tabindex="-1" data-submenu-item="true"
                                    @click.stop="$store.i18n.setLocale(language.code); subOpen = false; closeMenu(true)"
                                    class="group/dropdown-menu-item relative flex w-full cursor-pointer items-center justify-between gap-2 rounded-lg px-3 py-2 text-start text-sm font-medium outline-hidden transition-colors duration-200 select-none hover:bg-gray-100 dark:hover:bg-white/5"
                                    :class="$store.i18n && $store.i18n.currentLocale === language.code ?
                                        'bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-400' :
                                        'text-gray-700 dark:text-gray-300'">
                                    <span class="flex items-center gap-2">
                                        <span class="size-1.5 shrink-0 rounded-full transition-opacity"
                                            :class="$store.i18n && $store.i18n.currentLocale === language.code ?
                                                'bg-brand-500 opacity-100 dark:bg-brand-400' :
                                                'opacity-0'"></span>
                                        <img :src="language.flag" :alt="language.name"
                                            class="size-5 shrink-0 overflow-hidden rounded-full" />
                                        <span class="truncate" x-text="language.name"></span>
                                    </span>

                                    <template x-if="language.badge">
                                        <span
                                            class="rounded bg-amber-50 px-1.5 py-0.5 text-xs font-semibold text-amber-600 dark:bg-amber-500/15 dark:text-amber-400"
                                            x-text="language.badge"></span>
                                    </template>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="-mx-3 my-1.5 h-px bg-gray-100 dark:bg-gray-700"></div>

                    <!-- Sign Out (Destructive) -->
                    <a href="signin.html" role="menuitem" tabindex="-1"
                        class="group/dropdown-menu-item relative flex cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-red-500 outline-hidden transition-colors duration-200 select-none hover:bg-red-50 hover:text-red-600 focus:bg-red-50 focus:text-red-600 dark:text-red-400 dark:hover:bg-red-500/10 dark:hover:text-red-400 dark:focus:bg-red-500/10 dark:focus:text-red-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" class="size-5 text-red-500 dark:text-red-400">
                            <path
                                d="M4 12h7.75M8 8l-3.998 4 3.997 4M9.75 4.996V4.25a1.5 1.5 0 011.5-1.5h6a1.5 1.5 0 011.5 1.5v15.5a1.5 1.5 0 01-1.5 1.5h-6a1.5 1.5 0 01-1.5-1.5V19"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span x-text="$t('userDropdown.signOut')">Sign out</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
