@extends('layouts.admin.layout')

@section('additional-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="grid lg:grid-cols-2 gap-6 mt-8">
        <div class="card bg-transparent dark:border-gray-400">
            <div class="p-2">
                <div class="overflow-x-auto">
                    <table class="responsive-table">
                        <thead>
                            <tr>
                                <th scope="col" class="px-4 py-3 text-start text-sm text-default-500">
                                    Image</th>
                                <th scope="col" class="px-4 py-3 text-start text-sm text-default-500">
                                    Name
                                </th>
                                <th scope="col" class="px-4 py-3 text-start text-sm text-default-500">
                                    Description
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-sm text-default-500">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('assets/placeholder/food-tray.png') }}"
                                            alt="Category Image"
                                            class="rounded-full object-cover w-14 h-14 border-2 border-blueGray-50 shadow">
                                    </td>
                                    <td
                                        class="px-4 py-3 whitespace-nowrap text-sm font-medium text-default-800 dark:text-gray-400">
                                        {{ $category->name }}</td>
                                    <td class="px-4 py-3 whitespace-wrap text-sm text-default-800 dark:text-gray-400">
                                        {{ substr($category->description, 0, 50) }}...</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-center text-sm font-medium">
                                        <button class="text-white bg-transparent px-2 py-1"
                                            x-data @click="$dispatch('toggle-drawer')"
                                            onclick="editCategory({{ $category->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368" class="dark:hover:fill-white"><path d="M200-200h57l391-391-57-57-391 391v57Zm-40 80q-17 0-28.5-11.5T120-160v-97q0-16 6-30.5t17-25.5l505-504q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L313-143q-11 11-25.5 17t-30.5 6h-97Zm600-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                        </button>
                                        <button class="text-white bg-transparent py-1"
                                            onclick="deleteCategory({{ $category->id }}, this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368" class="dark:hover:fill-white"><path d="M280-120q-33 0-56.5-23.5T200-200v-520q-17 0-28.5-11.5T160-760q0-17 11.5-28.5T200-800h160q0-17 11.5-28.5T400-840h160q17 0 28.5 11.5T600-800h160q17 0 28.5 11.5T800-760q0 17-11.5 28.5T760-720v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM400-280q17 0 28.5-11.5T440-320v-280q0-17-11.5-28.5T400-640q-17 0-28.5 11.5T360-600v280q0 17 11.5 28.5T400-280Zm160 0q17 0 28.5-11.5T600-320v-280q0-17-11.5-28.5T560-640q-17 0-28.5 11.5T520-600v280q0 17 11.5 28.5T560-280ZM280-720v520-520Z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="">
            <div class="card bg-transparent dark:border-gray-400">
                <div class="p-6">
                    <h4 class="card-title mb-4">Basic Example</h4>

                    <form action="{{ route('admin.item-category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">

                            <div class="col-span-2">
                                <div class="relative">
                                    <div class="flex flex-col items-center justify-center h-40 rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 hover:border-indigo-500 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <input type="file" id="category-image" name="image" class="hidden" accept="image/*">
                                        <label for="category-image" class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                            <img src="" id="category-image-preview" class="hidden max-w-full max-h-full object-contain rounded-lg">
                                            <span id="upload-label" class="text-sm text-gray-500 dark:text-gray-400">
                                                Upload Image
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 col-span-4">
                                <div>
                                    <x-tailwind.floating.text-input name="name" label="Category Name" maxLength="255" />
                                    @error('name')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <x-tailwind.floating.textarea name="description" label="Category Description"
                                        maxLength="555" rows="3" />
                                    @error('description')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn bg-primary text-white">Submit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('offcanvas')

<x-tailwind.offcanvas title="Edit Category">
    <div id="edit-category-container">
        <form id="edit-category-form" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="mb-3 col-span-4">
                    <div>
                        <x-tailwind.floating.text-input name="edit_name" label="Category Name" maxLength="255" />
                        @error('edit_name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <x-tailwind.floating.textarea name="edit_description" label="Category Description"
                            maxLength="555" />
                        @error('edit_description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2">
                    <div class="relative">
                        <div class="flex flex-col items-center justify-center h-40 rounded-lg border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 hover:border-indigo-500 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <input type="file" id="edit-category-image" name="edit_image" class="hidden" accept="image/*">
                            <label for="edit-category-image" class="flex flex-col items-center justify-center w-full h-full cursor-pointer">
                                <img src="" id="edit-category-image-preview" class="hidden max-w-full max-h-full object-contain rounded-lg">
                                <span id="edit-upload-label" class="text-sm text-gray-500 dark:text-gray-400">
                                    Upload Image
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 text-end">
                    <button type="submit" class="btn bg-primary text-white">Save</button>
                </div>
            </div>
        </form>
    </div>
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
<script>
    const imageInput = document.getElementById('category-image');
    const imagePreview = document.getElementById('category-image-preview');
    const uploadLabel = document.getElementById('upload-label');

    imageInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
                uploadLabel.textContent = 'Change Image';
            }
            reader.readAsDataURL(file);
        }
    });

    const editImageInput = document.getElementById('edit-category-image');
    const editImagePreview = document.getElementById('edit-category-image-preview');
    const editUploadLabel = document.getElementById('edit-upload-label');

    editImageInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                editImagePreview.src = e.target.result;
                editImagePreview.classList.remove('hidden');
                editUploadLabel.textContent = 'Change Image';
            }
            reader.readAsDataURL(file);
        }
    });

    const editCategory = (categoryId) => {
        
        const name = document.getElementById('edit_name').value;
        const description = document.getElementById('edit_description').value;
        const image = document.getElementById('edit-category-image').files[0];
        
        fetch(`/admin/item-category/${categoryId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit-category-form').action = `/admin/item-category/${data.id}`;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_description').value = data.description;
            document.getElementById('edit-category-image-preview').src = '{{ asset('storage/') }}/' + data.image;
            document.getElementById('edit-category-image-preview').classList.remove('hidden');
            document.getElementById('edit-upload-label').textContent = 'Change Image';
        })
        .catch(error => {
            console.error(error);
        });
        
    }

    const deleteCategory = (categoryId, element) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/item-category/${categoryId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                Swal.fire(
                    'Deleted!',
                    'Category has been deleted.',
                    'success'
                ).then(() => {
                    // location.reload();
                    element.closest('tr').remove();
                });
            })
            .catch(error => {
                Swal.fire(
                    'Error!',
                    error.message || 'Failed to delete category',
                    'error'
                );
            });
        }
    });
}
</script>
@endsection