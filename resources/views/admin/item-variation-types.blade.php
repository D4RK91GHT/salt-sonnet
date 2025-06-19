@extends('layouts.admin.layout')

@section('content')
    <div class="grid lg:grid-cols-2 gap-6 mt-8">
        <div class="card bg-white dark:bg-gray-800 dark:text-white">
            <div class="p-2">
                <div class="overflow-x-auto">
                    <table class="responsive-table w-full">
                        <thead>
                            <tr>
                                <th scope="col" class="px-4 py-3 text-start text-sm text-default-500 dark:text-white">
                                    Name
                                </th>
                                <th scope="col" class="px-4 py-3 text-start text-sm text-default-500 dark:text-white">
                                    Description
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-sm text-default-500 dark:text-white">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($variationTypes as $variationType)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-default-800 dark:text-white">
                                        {{ $variationType->name }}</td>
                                    <td class="px-4 py-3 whitespace-wrap text-sm text-default-800 dark:text-white">
                                        {{ substr($variationType->description, 0, 50) }}...</td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <button x-data @click="$dispatch('toggle-drawer')" type="button"
                                            class="text-white bg-green-500 hover:bg-green-600 px-2 py-1 rounded" onclick="showMenuItem()">
                                            Edit
                                        </button>
    
                                        <form action="{{ route('admin.item-variation-types.destroy', $variationType) }}" method="POST"
                                            class="inline delete-form" id="delete-form-{{ $variationType->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
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
            </div>
        </div>

        <div class="">
            <div class="card bg-white dark:bg-gray-800 dark:text-white">
                <div class="p-6">
                    <h4 class="card-title mb-4 dark:text-white">Add New Variation Type</h4>

                    <form action="{{ route('admin.item-variation-types.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">

                            <div>
                                <x-tailwind.floating.text-input name="name" id="name" label="Name" type="text" required/>
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Discount Field -->
                            <div>
                                <x-tailwind.floating.text-input name="description" id="description" label="Description" type="text" required/>
                                @error('description')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Rate Field -->
                            <div>
                                @php
                                    $listArray = [
                                        (object)['id' => 1, 'name' => 'Yes'],
                                        (object)['id' => 0, 'name' => 'No'],
                                    ];
                                @endphp
                                <x-tailwind.floating.dropdown name="is_required" id="is_required" label="Is Required" :listArray="$listArray" listValue="id" listLabel="name"/>
                                @error('is_required')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn bg-primary text-white dark:text-white">Submit</button>
                    </form>

                </div>
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
