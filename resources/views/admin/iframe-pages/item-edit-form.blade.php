@extends('layouts.admin.iframe-layout')

@section('custom-header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
            <form id="edit-menu-item-form" action="{{ route('admin.menu-items.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="px-6 py-4">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-tailwind.floating.text-input name="name" value="{{ $menuItem->name }}" id="edit-name" label="Item Name" maxLength="255"/>
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <div>
                            <x-tailwind.floating.textarea name="includes" value="{{ $menuItem->includes }}" id="edit-includes" label="Includes" maxLength="355"/>
                            @error('includes')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
        
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-tailwind.floating.dropdown name="category" value="{{ $menuItem->category_id }}" id="edit-category" label="Category" :listArray="$categories" listValue="id" listLabel="name" />
                            @error('category')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <div>
                            <x-tailwind.floating.textarea name="description" value="{{ $menuItem->description }}" id="edit-description" label="Description" />
                            @error('description')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
        
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <!-- MRP Field -->
                        <div>
                            <x-tailwind.floating.text-input name="mrp" value="{{ $menuItem->mrp }}" id="edit-mrp" label="MRP" type="number" step="0.01" min="0" max="9999999.99" required oninput="calculatePrice('edit-')"/>
                            @error('mrp')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Discount Field -->
                        <div>
                            <x-tailwind.floating.text-input name="discount" value="{{ $menuItem->discount }}" id="edit-discount" label="Discount" type="number" step="0.01" min="0" max="100" required oninput="calculatePrice('edit-')"/>
                            @error('discount')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Rate Field -->
                        <div>
                            <x-tailwind.floating.text-input name="rate" value="{{ $menuItem->rate }}" id="edit-rate" label="Rate" type="number" step="0.01" readonly/>
                            @error('rate')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- GST Field -->
                        <div>
                            <x-tailwind.floating.dropdown name="gst" value="{{ $menuItem->gst }}" id="edit-gst" label="GST" :listArray="$gstSlabs" listValue="percentage" listLabel="percentage" listLabelPostfix="%" onchange="calculatePrice('edit-')" />
                            @error('gst')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Price Field -->
                        <div>
                            <x-tailwind.floating.text-input name="price" value="{{ $menuItem->price }}" id="edit-price" label="Price" type="number" step="0.01" readonly/>
                            @error('price')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
        
                    <div id="edit-variation-container">
                        @foreach ($menuItem->variations as $variation)
                            <div class="variation-row grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                                <input type="hidden" name="variations[${variation->id}][id]" value="{{ $variation->id }}">
                                <div>
                                    <x-tailwind.floating.dropdown name="variations[${variation->id}][variation_type_id]" value="{{ $variation->variation_type_id }}" id="variation_type_{{ $variation->id }}" label="Variation Type" :listArray="$variationTypes" listValue="id" listLabel="name" />
                                    @error('variations.' . $variation->id . '.variation_type_id')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <div>
                                    <x-tailwind.floating.text-input name="variations[${variation->id}][name]" value="{{ $variation->name }}" id="variation_name_{{ $variation->id }}" label="Variation Name" type="text" required/>
                                    @error('variations.' . $variation->id . '.name')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <x-tailwind.floating.text-input name="variations[${variation->id}][description]" value="{{ $variation->description }}" id="variation_description_{{ $variation->id }}" label="Description" type="text" />
                                    @error('variations.' . $variation->id . '.description')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <x-tailwind.floating.text-input name="variations[${variation->id}][price]" value="{{ $variation->price }}" id="variation_price_{{ $variation->id }}" label="Variation Price" type="number" step="0.01" required/>
                                    @error('variations.' . $variation->id . '.price')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex gap-2">
                                    <div class="w-1/2 flex flex-col gap-1">
                                        <div>
                                            <x-tailwind.floating.switch name="variations[${variation->id}][is_active]" label="Is Active" id="variation_is_active_{{ $variation->id }}" value="{{ $variation->is_active }}" />
                                        </div>
                                        <div>
                                            <x-tailwind.floating.switch name="variations[${variation->id}][is_default]" label="Is Default" id="variation_is_default_{{ $variation->id }}" value="{{ $variation->is_default }}" />
                                        </div>
                                    </div>
            
                                    <div class="w-1/2">
                                        <button type="button" 
                                            class="text-gray-400 bg-transparent rounded-lg border border-red-400 hover:bg-red-400 hover:text-red-600 text-sm p-1.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            onclick="deleteVariation(event, this, {{ $variation->id }})">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
            
                                </div>
                            </div>
                        @endforeach
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
                                @foreach ($menuItem->images as $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image"
                                            class="w-full h-48 object-cover">
                                        <button type="button" onclick="removeImage(this)"
                                            class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full">Remove</button>
                                    </div>
                                @endforeach
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
    <script src="{{ asset('assets/admin/js/item-page.js') }}"></script>
    <script>

        function deleteVariation(event, element, variationId) {


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
                    fetch(`/admin/item-variations/${variationId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                    })
                    .then(response => {
                        console.log(response);
                        if (response.ok) {
                            element.closest('.variation-row').remove();
                        }
                    })
                }
            });
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

        

        function variationTemplate(variationIndex, variationData = {}) {
            console.log(variationData);
            const variationId = variationData.id || '';
            const variationType = variationData.variation_type_id || '';
            const variationName = variationData.name || '';
            const variationDescription = variationData.description || '';
            const variationPrice = variationData.price || '';
            const variationIsActive = variationData.is_active || '';
            const variationIsDefault = variationData.is_default || '';

            const variationTemplate = `
                <div class="variation-row grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                <input type="hidden" name="variations[${variationIndex}][id]" value="${variationId}">
                    <div>
                        <x-tailwind.floating.dropdown 
                            name="variations[${variationIndex}][variation_type_id]" 
                            id="variation_type_${variationIndex}" 
                            label="Variation Type" 
                            :listArray="$variationTypes" 
                            listValue="id" 
                            listLabel="name" 
                            select="${variationType}"
                        />
                    </div>

                    <div>
                        <x-tailwind.floating.text-input 
                            name="variations[${variationIndex}][name]" 
                            id="variation_name_${variationIndex}" 
                            label="Variation Name" 
                            type="text" 
                            required
                            value="${variationName}"
                        />
                       
                    </div>

                    <div>
                        <x-tailwind.floating.text-input 
                            name="variations[${variationIndex}][description]" 
                            id="variation_description_${variationIndex}" 
                            label="Variation Description"
                            value="${variationDescription}"
                        />
                        
                    </div>

                    <div>
                        <x-tailwind.floating.text-input 
                            name="variations[${variationIndex}][price]" 
                            id="variation_price_${variationIndex}" 
                            label="Price" 
                            type="number" 
                            step="0.01"
                            value="${variationPrice}"
                        />
                        
                    </div>
                    <div class="flex gap-2">
                        <div class="w-1/2 flex flex-col gap-1">
                            <div>            
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="variations[${variationIndex}][is_active]" value="1" class="sr-only peer" ${variationIsActive ? 'checked' : ''}>
                                    <div class="relative w-11 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Is Active</span>
                                </label>

                            </div>
                            <div>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="variations[${variationIndex}][is_default]" value="1" class="sr-only peer" ${variationIsDefault ? 'checked' : ''}>
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
            return variationTemplate;
        }

        async function addVariation(idPrefix = '', variationData = {}) {
            const variationContainer = document.getElementById(idPrefix + 'variation-container');
            const variationIndex = document.querySelectorAll('#' + idPrefix + 'variation-container > .variation-row').length + 1;
            
            const variationTemplate = await this.variationTemplate(variationIndex, variationData);
            
            variationContainer.insertAdjacentHTML('beforeend', variationTemplate);
        }

    </script>
@endsection