@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm',
]) !!}>

{{-- This component provides a styled text input field with dark mode support.
    
    Props:
    - disabled: Boolean - Whether the input is disabled (default: false)
    - All other attributes will be merged into the input element
    
    Example usage:
    <x-text-input name="username" id="username" type="text" /> --}}
