<aside id="app-menu"
    class="bg-white dark:bg-gray-900 hs-overlay fixed inset-y-0 start-0 z-60 hidden w-sidenav min-w-sidenav -translate-x-full transform overflow-y-auto bg-body transition-all duration-300 hs-overlay-open:translate-x-0 lg:bottom-0 lg:end-auto lg:z-30 lg:block lg:translate-x-0 rtl:translate-x-full rtl:hs-overlay-open:translate-x-0 rtl:lg:translate-x-0 print:hidden [--body-scroll:true] [--overlay-backdrop:true] lg:[--overlay-backdrop:false]">
    <div class="sticky top-0 flex h-16 items-center justify-center px-6">
        <a href="index.html">
            <img src="{{ admin_asset('images/logo-dark.png') }}" alt="logo" class="flex h-10">
        </a>
    </div>

    <div class="h-[calc(100%-64px)] p-4 lg:ps-8" data-simplebar>
        <ul class="admin-menu hs-accordion-group flex w-full flex-col gap-1.5">
            <li class="menu-item">
                <a class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 transition-all hover:bg-default-900/5"
                    href="{{ route('admin.dashboard') }}">
                    <i data-lucide="airplay" class="size-5"></i>
                    Dashboard
                </a>
            </li>

            <li class="menu-item">
                <a href="starter-page.html"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5">
                    <i data-lucide="file-text" class="size-5"></i>
                    <span class="menu-text"> Starter Pages </span>
                </a>
            </li>

            <li class="menu-item hs-accordion">
                <a href="javascript:void(0)"
                    class="hs-accordion-toggle group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700 hs-accordion-active:dark:text-gray-400">
                    <i data-lucide="component" class="size-5"></i>
                    <span class="menu-text"> Item Menu </span>
                    <span
                        class="i-tabler-chevron-right ms-auto text-sm transition-all hs-accordion-active:rotate-90"></span>
                </a>

                <div class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-2 space-y-2">
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="{{ route('admin.item-category') }}">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Categories
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700  dark:text-gray-400 hover:bg-default-900/5"
                                href="{{ route('admin.item-variation-types') }}">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Variation Types
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="{{ route('admin.gst-slabs') }}">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                GST Slabs
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="{{ route('admin.menu-items') }}">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Menu Items
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="px-5 py-2 text-sm font-medium text-default-600">Elements</li>

            <li class="menu-item hs-accordion">
                <a href="javascript:void(0)"
                    class="hs-accordion-toggle group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700">
                    <i data-lucide="component" class="size-5"></i>
                    <span class="menu-text"> Components </span>
                    <span
                        class="i-tabler-chevron-right ms-auto text-sm transition-all hs-accordion-active:rotate-90"></span>
                </a>

                <div class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-2 space-y-2">
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-accordion.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Accordion
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-alerts.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Alert
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-avatars.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Avatars
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-buttons.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Buttons
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-badges.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Badges
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-breadcrumbs.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Breadcrumbs
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-cards.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Cards
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-collapse.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Collapse
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-dropdowns.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Dropdowns
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-progress.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Progress
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-spinners.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Spinners
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-skeleton.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Skeleton
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-ratio.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Ratio
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-modals.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Modals
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-offcanvas.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Offcanvas
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-popovers.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Popovers
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-tooltips.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Tooltips
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5"
                                href="ui-typography.html">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                Typography
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-item hs-accordion">
                <a href="javascript:void(0)"
                    class="hs-accordion-toggle group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700">
                    <i data-lucide="notebook-pen" class="size-5"></i>
                    <span class="menu-text"> Forms </span>
                    <span
                        class="i-tabler-chevron-right ms-auto text-sm transition-all hs-accordion-active:rotate-90"></span>
                </a>

                <div class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-2 space-y-2">
                        <li class="menu-item">
                            <a href="forms-inputs.html"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                <span class="menu-text">Inputs</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="forms-check-radio.html"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                <span class="menu-text">Checkbox & Radio</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="forms-masks.html"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                <span class="menu-text">Input Masks</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="forms-editor.html"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                <span class="menu-text">Editor</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="forms-validation.html"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                <span class="menu-text">Validation</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="forms-layout.html"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                <span class="menu-text">Form Layout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-item">
                <a href="maps-vector.html"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 transition-all hover:bg-default-900/5">
                    <i data-lucide="map" class="size-5"></i>
                    <span class="menu-text"> Maps </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="tables-basic.html"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700">
                    <i data-lucide="grid-3x3" class="size-5"></i>
                    <span class="menu-text"> Tables </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="charts-apex.html"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700">
                    <i data-lucide="chart-pie" class="size-5"></i>
                    <span class="menu-text"> Chart </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="icons.html"
                    class="group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 transition-all hover:bg-default-900/5">
                    <i data-lucide="dribbble" class="size-5"></i>

                    <span class="menu-text"> Icons </span>
                </a>
            </li>

            <li class="menu-item hs-accordion">
                <a href="javascript:void(0)"
                    class="hs-accordion-toggle group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700">
                    <i data-lucide="align-left" class="size-5"></i>
                    <span class="menu-text"> Level </span>
                    <span
                        class="i-tabler-chevron-right ms-auto text-sm transition-all hs-accordion-active:rotate-90"></span>
                </a>

                <div id="sidenavLevel"
                    class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                    <ul class="mt-2 space-y-2">
                        <li class="menu-item">
                            <a href="javascript: void(0)"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                <span class="menu-text">Item 1</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="javascript: void(0)"
                                class="flex items-center gap-x-3.5 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 hover:bg-default-900/5">
                                <i class="i-tabler-circle-filled scale-25 text-lg opacity-75"></i>
                                <span class="menu-text">Item 2</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-item">
                <a href="javascript:void(0)"
                    class="hs-accordion-toggle group flex items-center gap-x-4 rounded-md px-3 py-2 text-sm font-medium text-default-700 dark:text-gray-400 transition-all hover:bg-default-900/5 hs-accordion-active:bg-default-900/5 hs-accordion-active:text-default-700">
                    <i data-lucide="badge-check" class="size-5"></i>
                    <span class="menu-text"> Badge Items </span>
                    <span
                        class="ms-auto inline-flex items-center gap-x-1.5 py-0.5 px-2 rounded-md font-semibold text-xs bg-gray-800 text-white">Hot</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
