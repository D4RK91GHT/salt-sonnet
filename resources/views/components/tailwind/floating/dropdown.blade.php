@props([
    'name',
    'label',
    'id' => null,
    'value' => '',
    'listArray' => [],
    'listValue' => 'id',
    'listLabel' => 'name',
    'listLabelPostfix' => '',
])

<div class="relative mb-4">
    <select name="{{ $name }}" id="{{ $id ?? $name }}"
        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 dark:text-gray-300 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer @error($name) border-red-500 @enderror">
        <option value="" selected disabled>Select Category</option>
        @foreach ($listArray as $item)
            <option class="dark:text-gray-300 dark:bg-gray-800" {{ old($name, $value) == $item->{$listValue} ? 'selected' : '' }} value="{{ $item->{$listValue} }}">
                {{ $item->{$listLabel} . $listLabelPostfix }}</option>
        @endforeach
    </select>
    <label for="{{ $id ?? $name }}"
        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 dark:text-gray-300">{{ $label }}</label>
</div>
