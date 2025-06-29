<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    @yield('custom-header')
    <x-admin.meta-tags />
    <x-admin.header-links />

</head>

<body>

    <div class="bg-white dark:bg-gray-800 dark:text-white">
        <div class="container py-6">
            @yield('content')
        </div>
    </div>

    @stack('alerts')

    @yield('js')

    <x-admin.footer-js />

</body>

</html>
