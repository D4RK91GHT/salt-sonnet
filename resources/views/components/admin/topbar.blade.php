<header class="app-header md:hidden h-16 flex items-center lg:bg-opacity-10 bg-white  backdrop-blur-sm">
    <div class="container flex items-center gap-4">
        <!-- Topbar Brand Logo -->
        <a href="index.html" class="md:hidden flex">
            <img src="{{ admin_asset('images/logo-sm.png') }}" class="h-6" alt="Small logo">
        </a>

        <!-- Sidenav Menu Toggle Button -->
        <button id="button-toggle-menu" class="text-default-500 hover:text-default-600 p-2 rounded-full cursor-pointer"
            data-hs-overlay="#app-menu" aria-label="Toggle navigation">
            <i class="i-tabler-menu-2 text-2xl"></i>
        </button>

        <!-- Language Dropdown Button -->
        <div class="ms-auto hs-dropdown relative inline-flex [--placement:bottom-right]">
            <button type="button" class="hs-dropdown-toggle inline-flex items-center">
                <img src="{{ admin_asset('images/flags/us.jpg') }}" alt="user-image" class="h-4 w-6">
            </button>

            <div
                class="hs-dropdown-menu duration mt-2 min-w-48 rounded-lg border border-default-200 bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] hs-dropdown-open:opacity-100 hidden">
                <a href="javascript:void(0);"
                    class="flex items-center gap-2.5 py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100">
                    <img src="{{ admin_asset('images/flags/germany.jpg') }}" alt="user-image" class="h-4">
                    <span class="align-middle">German</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);"
                    class="flex items-center gap-2.5 py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100">
                    <img src="{{ admin_asset('images/flags/italy.jpg') }}" alt="user-image" class="h-4">
                    <span class="align-middle">Italian</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);"
                    class="flex items-center gap-2.5 py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100">
                    <img src="{{ admin_asset('images/flags/spain.jpg') }}" alt="user-image" class="h-4">
                    <span class="align-middle">Spanish</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);"
                    class="flex items-center gap-2.5 py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100">
                    <img src="{{ admin_asset('images/flags/russia.jpg') }}" alt="user-image" class="h-4">
                    <span class="align-middle">Russian</span>
                </a>
            </div>
        </div>

        <!-- Fullscreen Toggle Button -->
        <div class="md:flex hidden">
            <button data-toggle="fullscreen" type="button" class="nav-link p-2">
                <span class="sr-only">Fullscreen Mode</span>
                <span class="flex items-center justify-center size-6">
                    <i class="i-tabler-maximize text-2xl flex group-[-fullscreen]:hidden"></i>
                    <i class="i-tabler-minimize text-2xl hidden group-[-fullscreen]:flex"></i>
                </span>
            </button>
        </div>

        <!-- Profile Dropdown Button -->
        <div class="relative">
            <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                <button type="button" class="hs-dropdown-toggle nav-link flex items-center gap-2">
                    <img src="{{ admin_asset('images/users/avatar-4.jpg') }}" alt="user-image" class="rounded-full h-10">
                    <i class="i-tabler-chevron-down text-sm ms-2"></i>
                </button>
                <div
                    class="hs-dropdown-menu duration mt-2 min-w-48 rounded-lg border border-default-200 bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] hs-dropdown-open:opacity-100 hidden">
                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#">
                        Profile
                    </a>
                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#">
                        Feed
                    </a>
                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#">
                        Analytics
                    </a>
                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#">
                        Settings
                    </a>
                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#">
                        Support
                    </a>
                    <hr class="my-2">
                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#">
                        Log Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<header class="hidden md:flex h-16 items-center bg-white lg:bg-opacity-10 dark:bg-transparent  backdrop-blur-sm z-[50]" style="z-index: 50;">
    <div class="container flex items-center gap-4">
        <!-- Language Dropdown Button -->
        <div class="ms-auto hs-dropdown relative inline-flex [--placement:bottom-right]">
            <button type="button" class="hs-dropdown-toggle inline-flex items-center">
                <img src="{{ admin_asset('images/flags/us.jpg') }}" alt="user-image" class="h-4 w-6">
            </button>
            <div
                class="hs-dropdown-menu duration mt-2 min-w-48 rounded-lg border border-default-200 bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] hs-dropdown-open:opacity-100 hidden">
                <a href="javascript:void(0);"
                    class="flex items-center gap-2.5 py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100">
                    <img src="{{ admin_asset('images/flags/germany.jpg') }}" alt="user-image" class="h-4">
                    <span class="align-middle">German</span>
                </a>
                <a href="javascript:void(0);"
                    class="flex items-center gap-2.5 py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100">
                    <img src="{{ admin_asset('images/flags/italy.jpg') }}" alt="user-image" class="h-4">
                    <span class="align-middle">Italian</span>
                </a>
                <a href="javascript:void(0);"
                    class="flex items-center gap-2.5 py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100">
                    <img src="{{ admin_asset('images/flags/spain.jpg') }}" alt="user-image" class="h-4">
                    <span class="align-middle">Spanish</span>
                </a>
                <a href="javascript:void(0);"
                    class="flex items-center gap-2.5 py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100">
                    <img src="{{ admin_asset('images/flags/russia.jpg') }}" alt="user-image" class="h-4">
                    <span class="align-middle">Russian</span>
                </a>
            </div>
        </div>

        <!-- Fullscreen Toggle Button -->
        <div class="flex">
            <button data-toggle="fullscreen" type="button" class="nav-link p-2">
                <span class="sr-only">Fullscreen Mode</span>
                <span class="flex items-center justify-center size-6">
                    <i class="i-tabler-maximize text-2xl flex group-[-fullscreen]:hidden"></i>
                    <i class="i-tabler-minimize text-2xl hidden group-[-fullscreen]:flex"></i>
                </span>
            </button>
        </div>

        <!-- Profile Dropdown Button -->
        <div class="relative">
            <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
                <button type="button" class="hs-dropdown-toggle nav-link flex items-center gap-2">
                    <img src="{{ admin_asset('images/users/avatar-4.jpg') }}" alt="user-image" class="rounded-full h-10">
                    <i class="i-tabler-chevron-down text-sm ms-2"></i>
                </button>
                <div
                    class="hs-dropdown-menu duration mt-2 min-w-48 rounded-lg border border-default-200 bg-white p-2 opacity-0 shadow-md transition-[opacity,margin] hs-dropdown-open:opacity-100 hidden">
                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#">
                        Profile
                    </a>
                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#">
                        Feed
                    </a>
                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#">
                        Analytics
                    </a>
                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#">
                        Settings
                    </a>
                    <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#">
                        Support
                    </a>
                    <hr class="my-2">
                    {{-- <a class="flex items-center py-2 px-3 rounded-md text-sm text-default-800 hover:bg-gray-100"
                        href="#"> --}}
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <x-tailwind.primary-button class="w-full" onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-tailwind.primary-button>
                        </form>
                    {{-- </a> --}}
                </div>
            </div>
        </div>
    </div>
</header>