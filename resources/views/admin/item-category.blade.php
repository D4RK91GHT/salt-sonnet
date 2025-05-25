@extends('layouts.admin.layout')

@section('content')
    <div class="grid lg:grid-cols-2 gap-6 mt-8">
        <div class="card">
            <div class="p-2">
                <div class="overflow-hidden border rounded-lg shadow-lg">
                    <table class="min-w-full divide-y divide-gray-200 responsive-table">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                    Name</th>
                                <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-start text-sm text-default-500">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-end text-sm text-default-500">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($categories as $category)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image"
                                            class="rounded-full object-cover border border-gray-200"
                                            style="width: 60px; height: 60px;">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-default-800">
                                        {{ $category->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-default-800">
                                        {{ $category->description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a class="text-primary hover:text-sky-700" href="#">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="">
            <div class="card">
                <div class="p-6">
                    <h4 class="card-title mb-4">Basic Example</h4>

                    <form action="{{ route('admin.item-category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">

                            <div class="relative">
                                <input type="text" id="category-name" name="name" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="category-name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Category Name</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="relative">
                                <textarea id="category-description" name="description" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" maxlength="555"></textarea>
                                <label for="category-description" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Category Description</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="relative">
                                <input type="file" id="category-image" name="image" class="hidden" accept="image/*">
                                <label for="category-image" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                    <span class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Category Image</span>
                                    <img src="" id="category-image-preview" class="max-w-full h-40 object-cover rounded-lg border-1 border-gray-300">
                                </label>
                            </div>
                            <script>
                                const imageInput = document.getElementById('category-image');
                                const imagePreview = document.getElementById('category-image-preview');

                                imageInput.addEventListener('change', (e) => {
                                    const file = e.target.files[0];
                                    const reader = new FileReader();

                                    reader.onload = (e) => {
                                        imagePreview.src = e.target.result;
                                    }

                                    reader.readAsDataURL(file);
                                });
                            </script>
                        </div>

                        <button type="submit" class="btn bg-primary text-white">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection;

@push('alerts')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endpush
