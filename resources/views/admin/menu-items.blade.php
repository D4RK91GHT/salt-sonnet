@extends('layouts.admin.layout')
<style>
    .preview-item {
        transition: opacity 0.2s;
    }

    .preview-item:hover {
        opacity: 0.9;
    }

    .preview-item img {
        transition: transform 0.3s ease;
    }

    .preview-item:hover img {
        transform: scale(1.05);
    }
</style>
@section('content')
    <div class="mt-8">

        <div class="flex items-center justify-between mb-4">
            <h4 class="card-title mb-4">Menu Items</h4>
            <div x-data="{ open: false }" class="inline">
                <x-tailwind.primary-button @click="open = true" type="button">Add New Item</x-tailwind.primary-button>
                <!-- Modal -->
                <div x-show="open"
                    class="fixed inset-0 flex items-center justify-center z-50 overflow-x-hidden overflow-y-auto"
                    style="display: none;">
                    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" @click="open = false"></div>
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-[50%] mx-auto z-50 overflow-x-hidden overflow-y-auto">
                        <div class="flex justify-between items-center px-6 py-4">
                            <h3 class="text-lg font-semibold">Add New Menu Item</h3>
                            <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
                        </div>
                        <form action="{{ route('admin.menu-items.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-tailwind.floating.text-input name="name" label="Item Name" maxLength="255"/>
                                        @error('name')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <x-tailwind.floating.textarea name="includes" label="Includes" maxLength="355"/>
                                        @error('includes')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-tailwind.floating.dropdown name="category" label="Category" :listArray="$categories" listValue="id" listLabel="name" />
                                        @error('category')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <x-tailwind.floating.textarea name="description" label="Description" />
                                        @error('description')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                                    <!-- MRP Field -->
                                    <div>
                                        <x-tailwind.floating.text-input name="mrp" id="mrp" label="MRP" type="number" step="0.01" min="0" max="9999999.99" required oninput="calculatePrice()"/>
                                        @error('mrp')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Discount Field -->
                                    <div>
                                        <x-tailwind.floating.text-input name="discount" id="discount" label="Discount" type="number" step="0.01" min="0" max="100" required oninput="calculatePrice()"/>
                                        @error('discount')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Rate Field -->
                                    <div>
                                        <x-tailwind.floating.text-input name="rate" id="rate" label="Rate" type="number" step="0.01" readonly/>
                                        @error('rate')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- GST Field -->
                                    <div>
                                        <x-tailwind.floating.dropdown name="gst" label="GST" :listArray="$gstSlabs" listValue="percentage" listLabel="percentage" onchange="calculatePrice()" />
                                        @error('gst')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Price Field -->
                                    <div>
                                        <x-tailwind.floating.text-input name="price" id="price" label="Price" type="number" step="0.01" readonly/>
                                        @error('price')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <p class="text-sm font-semibold mb-4 ps-2">Variations</p>
                                <div id="variation-container">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <!-- Variation Fields -->
                                    <div>
                                        <div>

                                            <x-tailwind.floating.dropdown name="variations[0][variation_type_id]" label="Variation Type" :listArray="$variationTypes" listValue="id" listLabel="name" />
                                            @error('variations.0.variation_type_id')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <x-tailwind.floating.text-input name="variations[0][name]" id="variation_name_0" label="Variation Name" type="text" required/>
                                            @error('variations.0.name')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description Field -->
                                    <div>
                                        <x-tailwind.floating.text-input name="variations[0][description]" id="variation_description_0" label="Variation Description"/>
                                        @error('variations.0.description')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Price Field -->
                                    <div>
                                        <x-tailwind.floating.text-input name="variations[0][price]" id="variation_price_0" label="Price" type="number" step="0.01"/>
                                        @error('variations.0.price')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <div>
                                            
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="variations[0][is_active]" value="1" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Is Active</span>
                                            </label>

                                        </div>
                                        <div>
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="variations[0][is_default]" value="1" class="sr-only peer">
                                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Is Default</span>
                                            </label>
                                            @error('variations.0.is_default')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                                <button type="button" onclick="addVariation()" class="px-6 py-2 bg-blue-500 text-white rounded-lg">Add Variation</button>
                               

                                <div class="col-span-full">
                                    <label for="image-upload" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Upload
                                        Images</label>
                                    <div class="mt-2 flex flex-col space-y-4">
                                        <!-- Image preview container -->
                                        <div id="image-preview"
                                            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                            <!-- Preview items will be added here dynamically -->
                                        </div>

                                        <!-- Upload area -->
                                        <div
                                            class="mt-1 flex justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 hover:border-indigo-500 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                                    <label for="image-upload"
                                                        class="relative cursor-pointer rounded-md font-medium text-indigo-600 focus-within:outline-none hover:text-indigo-500 dark:hover:text-indigo-500">
                                                        <span>Upload files</span>
                                                        <input id="image-upload" name="images[]" type="file"
                                                            class="sr-only" multiple accept="image/*">
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 10MB each</p>
                                            </div>
                                        </div>
                                        @error('images')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="flex justify-end px-6 py-4">
                                <button type="button" @click="open = false"
                                    class="mr-2 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                                <button type="submit"
                                    class="px-4 py-2 bg-primary text-white rounded hover:bg-indigo-600">Save Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div>
            <div class="overflow-x-auto border rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 responsive-table">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                SL No</th>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                Item
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                MRP
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                Discount
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                Rate
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                GST
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                Is Available
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-sm text-default-500">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($menuItems as $menuItem)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800 dark:text-white">
                                    {{-- {{ ($menuItems->currentPage() - 1) * $menuItems->perPage() + $loop->index + 1 }} --}}
                                    {{ $menuItem->id }}
                                </td>

                                <td
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                    <div class="flex">
                                        @if ($menuItem->images->count() > 0)
                                            @foreach ($menuItem->images->take(3) as $image)
                                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="..."
                                                    class="w-14 h-14 rounded-full border-2 border-blueGray-50 shadow @if (!$loop->first) -ml-4 @endif">
                                            @endforeach
                                        @else
                                            <img src="{{ asset('assets/placeholder/Item-300x300.jpg') }}" alt="..."
                                                class="w-14 h-14 rounded-full border-2 border-blueGray-50 shadow">
                                            <img src="{{ asset('assets/placeholder/Item-300x300.jpg') }}" alt="..."
                                                class="w-14 h-14 rounded-full border-2 border-blueGray-50 shadow -ml-4">
                                            <img src="{{ asset('assets/placeholder/Item-300x300.jpg') }}" alt="..."
                                                class="w-14 h-14 rounded-full border-2 border-blueGray-50 shadow -ml-4">
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800 dark:text-white">
                                    <p class="font-semibold">{{ $menuItem->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $menuItem->category_name }}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800 dark:text-white">
                                    {{ $menuItem->mrp }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800 dark:text-white">
                                    {{ $menuItem->discount }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800 dark:text-white">
                                    {{ $menuItem->rate }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800 dark:text-white">
                                    {{ $menuItem->gst }}%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800 dark:text-white">
                                    {{ $menuItem->price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800 dark:text-white">
                                    @if ($menuItem->is_available)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Available
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                                            Out Of Stock
                                        </span>
                                    @endif

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <button x-data @click="$dispatch('toggle-drawer')" type="button"
                                        class="text-white bg-green-500 hover:bg-green-600 px-2 py-1 rounded" onclick="showMenuItem({{ $menuItem->id }})">
                                        Edit
                                    </button>

                                    <form action="{{ route('admin.menu-items.destroy', $menuItem) }}" method="POST"
                                        class="inline delete-form" id="delete-form-{{ $menuItem->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                            onclick="confirmDelete(event, 'delete-form-{{ $menuItem->id }}')"
                                            class="text-white bg-red-600 hover:bg-red-500 px-2 py-1 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $menuItems->onEachSide(1)->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection

@section('offcanvas')

<x-tailwind.offcanvas title="Edit Menu Item">
    <form id="edit-menu-item-form" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="px-6 py-4">
            <input type="hidden" name="id" id="edit-id">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-tailwind.floating.text-input name="name" id="edit-name" label="Item Name" maxLength="255"/>
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-tailwind.floating.textarea name="includes" id="edit-includes" label="Includes" maxLength="355"/>
                    @error('includes')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-tailwind.floating.dropdown name="category" id="edit-category" label="Category" :listArray="$categories" listValue="id" listLabel="name" />
                    @error('category')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-tailwind.floating.textarea name="description" id="edit-description" label="Description" />
                    @error('description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- MRP Field -->
                <div>
                    <x-tailwind.floating.text-input name="mrp" id="edit-mrp" label="MRP" type="number" step="0.01" min="0" max="9999999.99" required oninput="calculatePrice('edit-')"/>
                    @error('mrp')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Discount Field -->
                <div>
                    <x-tailwind.floating.text-input name="discount" id="edit-discount" label="Discount" type="number" step="0.01" min="0" max="100" required oninput="calculatePrice('edit-')"/>
                    @error('discount')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rate Field -->
                <div>
                    <x-tailwind.floating.text-input name="rate" id="edit-rate" label="Rate" type="number" step="0.01" readonly/>
                    @error('rate')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- GST Field -->
                <div>
                    <x-tailwind.floating.dropdown name="gst" id="edit-gst" label="GST" :listArray="$gstSlabs" listValue="percentage" listLabel="percentage" listLabelPostfix="%" onchange="calculatePrice('edit-')" />
                    @error('gst')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price Field -->
                <div>
                    <x-tailwind.floating.text-input name="price" id="edit-price" label="Price" type="number" step="0.01" readonly/>
                    @error('price')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div id="edit-variation-container">

            </div>
            
            <div class="text-end">
                <button type="button" onclick="addVariation('edit-')" class="bg-primary text-white px-4 py-2 rounded-lg">Add Variation</button>
            </div>

            <div class="col-span-full">
                <label for="edit-image-upload" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Upload
                    Images</label>
                <div class="mt-2 flex flex-col space-y-4">
                    <!-- Image preview container -->
                    <div id="edit-image-preview"
                        class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        <!-- Preview items will be added here dynamically -->
                    </div>

                    <!-- Upload area -->
                    <div
                        class="mt-1 flex justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 hover:border-indigo-500 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                <label for="edit-image-upload"
                                    class="relative cursor-pointer rounded-md font-medium text-indigo-600 focus-within:outline-none hover:text-indigo-500 dark:hover:text-indigo-500">
                                    <span>Upload files</span>
                                    <input id="edit-image-upload" name="edit-images[]" type="file"
                                        class="sr-only" multiple accept="image/*">
                                    <input class="hidden" type="file" id="delete-image" name="delete-images[]" multiple accept="image/*">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 10MB each</p>
                        </div>
                    </div>
                    @error('edit-images')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>
        <div class="flex justify-end px-6 py-4">
            <button type="button" @click="open = false"
                class="mr-2 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
            <button type="submit"
                class="px-4 py-2 bg-primary text-white rounded hover:bg-indigo-600">Save Item</button>
        </div>
    </form>
</x-tailwind.offcanvas>

@endsection

@push('alerts')
    @if (session('success'))
        <x-admin.alert type="success" :message="session('success')" />
    @endif
    @if (session('error'))
        <x-admin.alert type="error" :message="session('error')" />
    @endif
@endpush

@section('js')
    <!-- Alpine.js CDN (if not already included) -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> --}}
    <script>
        function showMenuItem(id) {
            fetch(`/admin/menu-items/${id}`)
                .then(response => response.json())
                .then(data => {
                    // Update the form fields with the fetched data
                    document.getElementById('edit-menu-item-form').action = `/admin/menu-items/${data.id}`;
                    document.getElementById('edit-id').value = data.id;

                    document.getElementById('edit-name').value = data.name;
                    document.getElementById('edit-includes').value = data.includes;
                    document.getElementById('edit-category').value = data.category_id;
                    document.getElementById('edit-description').value = data.description;
                    document.getElementById('edit-mrp').value = data.mrp;
                    document.getElementById('edit-discount').value = data.discount;
                    document.getElementById('edit-gst').value = data.gst;
                    console.log(data.images);

                    // Update the image preview
                    const fileInput = document.getElementById('edit-image-upload');
                    const deleteInput = document.getElementById('delete-image');
                    const maxFiles = 10; // Maximum number of files allowed
                    const previewContainer = document.getElementById('edit-image-preview');
                    previewContainer.innerHTML = '';
                    data.images.forEach(image => {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'preview-item relative group';
                        previewItem.innerHTML = `
                            <img src="${'{{ asset('storage/') }}/' + image.image_path}" class="h-24 w-full object-cover rounded-lg">
                            <button type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity" data-dz-remove>
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        `;
                        previewItem.querySelector('button').addEventListener('click', function() {
                            console.log('Removing file:', image.image_path);
                            previewItem.remove();
                            const dt = new DataTransfer();
                            const input = fileInput;
                            const files = input.files;
                            for (let i = 0; i < files.length; i++) {
                                const f = files[i];
                                if (f !== file) {
                                    dt.items.add(f);
                                }
                            }
                            input.files = dt.files;
                        });
                        previewContainer.appendChild(previewItem);
                    });
                    fileInput.addEventListener('change', function(e) {
                        const files = Array.from(e.target.files);
                        if (!e.ctrlKey) {
                            previewContainer.innerHTML = '';
                        }
                        const currentFiles = previewContainer.querySelectorAll('.preview-item').length;
                        if (currentFiles + files.length > maxFiles) {
                            alert(`You can only upload up to ${maxFiles} images.`);
                            return;
                        }
                        files.forEach(file => {
                            if (!file.type.startsWith('image/')) {
                                alert(`Skipped ${file.name}: Not an image file`);
                                return;
                            }
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const previewItem = document.createElement('div');
                                previewItem.className = 'preview-item relative group';
                                previewItem.innerHTML = `
                                    <img src="${e.target.result}" class="h-24 w-full object-cover rounded-lg">
                                    <button type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity" data-dz-remove>
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                `;
                                previewItem.querySelector('button').addEventListener('click', function() {
                                    console.log('Removing file:', file.name);
                                    previewItem.remove();
                                    const dt = new DataTransfer();
                                    const input = fileInput;
                                    const files = input.files;
                                    for (let i = 0; i < files.length; i++) {
                                        const f = files[i];
                                        if (f !== file) {
                                            dt.items.add(f);
                                        }
                                    }
                                    input.files = dt.files;
                                });
                                previewContainer.appendChild(previewItem);
                            }
                            reader.readAsDataURL(file);
                        });
                    });

                })
                .catch(error => console.error('Error fetching menu item:', error));
        }


        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('image-upload');
            const previewContainer = document.getElementById('image-preview');
            const maxFiles = 10; // Maximum number of files allowed

            fileInput.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);

                // Clear previous previews if not holding Ctrl key
                if (!e.ctrlKey) {
                    previewContainer.innerHTML = '';
                }

                // Check total files won't exceed max
                const currentFiles = previewContainer.querySelectorAll('.preview-item').length;
                if (currentFiles + files.length > maxFiles) {
                    alert(`You can only upload up to ${maxFiles} images.`);
                    return;
                }

                files.forEach(file => {
                    if (!file.type.startsWith('image/')) {
                        alert(`Skipped ${file.name}: Not an image file`);
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'preview-item relative group';
                        previewItem.innerHTML = `
                                                    <div class="relative aspect-square overflow-hidden rounded-lg border border-gray-200">
                                                        <img src="${e.target.result}" alt="Preview" class="h-full w-full object-cover">
                                                        <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                `;

                        // Add remove functionality
                        const removeBtn = previewItem.querySelector('button');
                        removeBtn.addEventListener('click', function() {
                            previewItem.remove();
                            // Remove the file from the file input
                            const dt = new DataTransfer();
                            const input = fileInput;
                            const {
                                files
                            } = input;

                            for (let i = 0; i < files.length; i++) {
                                const f = files[i];
                                if (f !== file) {
                                    dt.items.add(f);
                                }
                            }

                            input.files = dt.files;
                        });

                        previewContainer.appendChild(previewItem);
                    };
                    reader.readAsDataURL(file);
                });
            });

            // Handle drag and drop
            const dropZone = fileInput.closest('div[class*="border-dashed"]');
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropZone.classList.add('border-indigo-500', 'bg-indigo-50');
            }

            function unhighlight() {
                dropZone.classList.remove('border-indigo-500', 'bg-indigo-50');
            }

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                const event = new Event('change');
                fileInput.dispatchEvent(event);
            }

        });
        const calculatePrice = (idPrefix = '') => {
            const mrp = parseFloat(document.getElementById(idPrefix + 'mrp').value) || 0;
            const discount = parseFloat(document.getElementById(idPrefix + 'discount').value) || 0;
            const gstPercentage = parseFloat(document.getElementById(idPrefix + 'gst').value) || 0;

            // Calculate rate (MRP - (MRP * (discount/100)))
            const rate = mrp - (mrp * (discount / 100));
            document.getElementById(idPrefix + 'rate').value = rate.toFixed(2);

            // Calculate price (LEAST(rate + (rate * (gst/100)), mrp))
            const priceWithGst = rate + (rate * (gstPercentage / 100));
            const finalPrice = Math.min(priceWithGst, mrp);
            document.getElementById(idPrefix + 'price').value = finalPrice.toFixed(2);
        }

        function confirmDelete(event, formId) {
            event.preventDefault();
    
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700',
                    cancelButton: 'px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 ml-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }

        function addVariation(idPrefix = '') {
            const variationContainer = document.getElementById(idPrefix + 'variation-container');
            const variationIndex = document.querySelectorAll('#' + idPrefix + 'variation-container > .variation-row').length + 1;
            
            const variationTemplate = `
                <div class="variation-row grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                    <div>
                        <x-tailwind.floating.dropdown 
                            name="variations[${variationIndex}][variation_type_id]" 
                            id="variation_type_${variationIndex}" 
                            label="Variation Type" 
                            :listArray="$variationTypes" 
                            listValue="id" 
                            listLabel="name" 
                        />
                    </div>

                    <div>
                        <x-tailwind.floating.text-input 
                            name="variations[${variationIndex}][name]" 
                            id="variation_name_${variationIndex}" 
                            label="Variation Name" 
                            type="text" 
                            required
                        />
                       
                    </div>

                    <div>
                        <x-tailwind.floating.text-input 
                            name="variations[${variationIndex}][description]" 
                            id="variation_description_${variationIndex}" 
                            label="Variation Description"
                        />
                        
                    </div>

                    <div>
                        <x-tailwind.floating.text-input 
                            name="variations[${variationIndex}][price]" 
                            id="variation_price_${variationIndex}" 
                            label="Price" 
                            type="number" 
                            step="0.01"
                        />
                        
                    </div>
                    <div class="flex gap-2">
                        <div class="w-1/2 flex flex-col gap-1">
                            <div>            
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="variations[${variationIndex}][is_active]" value="1" class="sr-only peer">
                                    <div class="relative w-11 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Is Active</span>
                                </label>

                            </div>
                            <div>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="variations[${variationIndex}][is_default]" value="1" class="sr-only peer">
                                    <div class="relative w-11 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Is Default</span>
                                </label>
                            </div>
                        </div>

                        <div class="w-1/2">
                            <button type="button" 
                                class="text-gray-400 bg-transparent rounded-lg border border-red-400 hover:bg-red-400 hover:text-red-600 text-sm p-1.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                onclick="this.closest('.variation-row').remove()">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>

                    </div>
                    
                </div>
            `;
            
            variationContainer.insertAdjacentHTML('beforeend', variationTemplate);
        }
    </script>
@endsection