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
                        class="bg-white rounded-lg shadow-lg w-full max-w-[50%] mx-auto z-50 overflow-x-hidden overflow-y-auto">
                        <div class="flex justify-between items-center px-6 py-4 border-b">
                            <h3 class="text-lg font-semibold">Add New Menu Item</h3>
                            <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
                        </div>
                        <form action="{{ route('admin.menu-items.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <div class="relative mb-4">
                                            <input type="text" id="name" name="name"
                                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('name') border-red-500 @enderror"
                                                placeholder=" " value="{{ old('name') }}"/>
                                            <label for="name"
                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Item
                                                Name</label>
                                        </div>
                                        @error('name')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="relative mb-4">
                                            <textarea id="includes" name="includes"
                                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('includes') border-red-500 @enderror"
                                                placeholder=" " maxlength="355" value="{{ old('includes') }}"></textarea>
                                            <label for="includes"
                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Includes</label>
                                        </div>
                                        @error('includes')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <div>
                                        <div class="relative mb-4">
                                            <select name="category" id="category"
                                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('category') border-red-500 @enderror">
                                                <option value="" selected disabled>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option {{ old('category') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="category"
                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Category</label>
                                        </div>
                                        @error('category')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <div class="relative mb-4">
                                            <textarea id="description" name="description"
                                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('description') border-red-500 @enderror"
                                                placeholder="" maxlength="555" value="{{ old('description') }}"></textarea>
                                            <label for="description"
                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Description</label>
                                        </div>
                                        @error('description')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                                    <!-- MRP Field -->
                                    <div>
                                        <div class="relative mb-1">
                                            <input type="number" id="mrp" name="mrp" step="0.01" min="0" max="9999999.99" required
                                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('mrp') border-red-500 @enderror"
                                                placeholder=" " oninput="calculatePrice()" value="{{ old('mrp') }}" />
                                            <label for="mrp"
                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">MRP</label>
                                        </div>
                                        @error('mrp')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                
                                    <!-- Discount Field -->
                                    <div>
                                        <div class="relative mb-1">
                                            <input type="number" id="discount" name="discount" step="0.01" min="0" max="100" 
                                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('discount') border-red-500 @enderror"
                                                placeholder=" " oninput="calculatePrice()" value="{{ old('discount', 0) }}" />
                                            <label for="discount"
                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Discount %</label>
                                        </div>
                                        @error('discount')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                
                                    <!-- Rate Field -->
                                    <div>
                                        <div class="relative mb-1">
                                            <input type="number" id="rate" name="rate" step="0.01" readonly
                                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('rate') border-red-500 @enderror"
                                                placeholder=" " value="{{ old('rate') }}" />
                                            <label for="rate"
                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Rate</label>
                                        </div>
                                        @error('rate')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                
                                    <!-- GST Field -->
                                    <div>
                                        <div class="relative mb-1">
                                            <select name="gst" id="gst" onchange="calculatePrice()"
                                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('gst') border-red-500 @enderror">
                                                <option value="" selected disabled>Select GST</option>
                                                @foreach ($gstSlabs as $gstSlab)
                                                    <option value="{{ $gstSlab->percentage }}" {{ old('gst') == $gstSlab->percentage ? 'selected' : '' }}>{{ $gstSlab->percentage }}%</option>
                                                @endforeach
                                            </select>
                                            <label for="gst"
                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">GST</label>
                                        </div>
                                        @error('gst')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                
                                    <!-- Price Field -->
                                    <div>
                                        <div class="relative mb-1">
                                            <input type="number" id="price" name="price" step="0.01" readonly
                                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer @error('price') border-red-500 @enderror"
                                                placeholder=" " value="{{ old('price') }}" />
                                            <label for="price"
                                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Price</label>
                                        </div>
                                        @error('price')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-span-full">
                                    <label for="image-upload" class="block text-sm font-medium text-gray-900">Upload
                                        Images</label>
                                    <div class="mt-2 flex flex-col space-y-4">
                                        <!-- Image preview container -->
                                        <div id="image-preview"
                                            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                            <!-- Preview items will be added here dynamically -->
                                        </div>

                                        <!-- Upload area -->
                                        <div
                                            class="mt-1 flex justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 hover:border-indigo-500 hover:bg-gray-50 transition-colors">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="image-upload"
                                                        class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none hover:text-indigo-500">
                                                        <span>Upload files</span>
                                                        <input id="image-upload" name="images[]" type="file"
                                                            class="sr-only" multiple accept="image/*">
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB each</p>
                                            </div>
                                        </div>
                                        @error('images')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="flex justify-end px-6 py-4 border-t">
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
            <div class="overflow-hidden border rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 responsive-table">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                SL No</th>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                Category
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
                            <th scope="col" class="px-6 py-3 text-end text-sm text-default-500">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($menuItems as $menuItem)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                    <div class="flex space-x-2">
                                        @foreach($menuItem->images->take(3) as $image)
                                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                 alt="Menu item image" 
                                                 class="w-12 h-12 object-cover rounded">
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                    {{ $menuItem->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                    {{ $menuItem->category_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                    {{ $menuItem->mrp }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                    {{ $menuItem->discount }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                    {{ $menuItem->rate }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                    {{ $menuItem->gst }}%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                    {{ $menuItem->price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                    {{ $menuItem->is_available }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <form action="{{ route('admin.menu-items.destroy', $menuItem) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-500 hover:bg-red-600 px-2 py-1 rounded">
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
@endsection;

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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
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
                                                        <button type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
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
    </script>
@endsection

@push('scripts')
<script>
function calculatePrice() {
    const mrp = parseFloat(document.getElementById('mrp').value) || 0;
    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const gstPercentage = parseFloat(document.getElementById('gst').value) || 0;
    
    // Calculate rate (MRP - (MRP * (discount/100)))
    const rate = mrp - (mrp * (discount / 100));
    document.getElementById('rate').value = rate.toFixed(2);
    
    // Calculate price (LEAST(rate + (rate * (gst/100)), mrp))
    const priceWithGst = rate + (rate * (gstPercentage / 100));
    const finalPrice = Math.min(priceWithGst, mrp);
    document.getElementById('price').value = finalPrice.toFixed(2);
}
</script>
@endpush
