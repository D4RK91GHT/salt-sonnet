<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    
    <x-admin.meta-tags />
    <x-admin.header-links />

</head>

<body>

    <div class="wrapper">

        <!-- Start Sidebar -->
        <x-admin.sidebar-nav />
        <!-- End Sidebar -->


        <!-- Mobile Nav Start -->
        <x-admin.mobile-nav />
        <!-- Mobile Nav End -->

        <!-- Start Page Content here -->
        <div class="page-content bg-white dark:bg-gray-900 dark:text-white">

            <!-- Topbar Start -->
            <x-admin.topbar />
            <!-- Topbar End -->
            
            <main class="bg-white dark:bg-gray-800 dark:text-white">
                <div class="container py-6">


                    <!-- Page Title Start -->
                    <div class="flex items-center md:justify-between flex-wrap gap-2 mb-6">
                        <h4 class="text-default-900 text-lg font-medium mb-2">Dashboard</h4>


                        <!-- <div class="md:flex hidden items-center gap-3 text-sm font-semibold">
                            <a href="#" class="text-sm font-medium text-default-700">AdminHub</a>
                            <i class="material-symbols-rounded text-xl flex-shrink-0 text-default-500">chevron_right</i>
                            <a href="#" class="text-sm font-medium text-default-700">Menu</a>
                            <i class="material-symbols-rounded text-xl flex-shrink-0 text-default-500">chevron_right</i>
                            <a href="#" class="text-sm font-medium text-default-700" aria-current="page">Dashboard</a>
                        </div> -->
                    </div>
                    <!-- Page Title End -->

                    @yield('content')
                    
                </div>
            </main>
            @yield('offcanvas')

        </div>
        <!-- End Page content -->

    </div>

    @stack('alerts')

    @yield('js')
    
    <x-admin.footer-js />

</body>

</html>