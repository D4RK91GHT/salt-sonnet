@props(['name', 'label', 'id' => null, 'value' => '', 'rows' => ""])

@php
    $textareaClass = 'block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 dark:text-gray-300 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer' . ($errors->has($name) ? ' border-red-500' : '');
@endphp

<div class="relative mb-4">
    <textarea id="{{ $id ?? $name }}" name="{{ $name }}" {{ $attributes->merge(['class' => $textareaClass]) }} placeholder=" " rows="{{ $rows }}">{{ old($name) ?? $value }}</textarea>
    <label for="{{ $id ?? $name }}"
        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 dark:text-gray-300">{{ $label }}</label>
</div>
