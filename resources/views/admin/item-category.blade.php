@extends('layouts.admin.layout')

@section('content')
    <div class="grid lg:grid-cols mt-8">
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden border rounded-lg shadow-lg">
                    <table class="min-w-full divide-y divide-gray-200">
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
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="rounded-full object-cover border border-gray-200" style="width: 60px; height: 60px;">
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
    </div>

    <div class="card mt-5">
        <div class="p-6">
            <h4 class="card-title mb-4">Basic Example</h4>

            <form action="{{ route('admin.item-category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="category-name" class="text-default-800 text-sm font-medium inline-block mb-2">Category Name</label>
                    <input type="text" class="form-input" id="category-name" name="name" aria-describedby="category-name" placeholder="Enter Category Name">
                </div>
                
                <div class="mb-3">
                    <label for="category-description" class="text-default-800 text-sm font-medium inline-block mb-2">Category Description</label>
                    <input type="text" class="form-input" id="category-description" name="description" aria-describedby="category-description" placeholder="Enter Category Description">
                </div>
                
                <div class="mb-3">
                    <label for="category-image" class="text-default-800 text-sm font-medium inline-block mb-2">Category Image</label>
                    <input type="file" class="form-input" id="category-image" name="image" aria-describedby="category-image" placeholder="Enter Category Image">
                </div>
                
                <button type="submit" class="btn bg-primary text-white">Submit</button>
            </form>

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
