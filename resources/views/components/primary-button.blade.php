@props(['disabled' => false])

<button 
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150',
        'disabled' => $disabled
    ]) }}
    {{ $disabled ? 'disabled' : '' }}
>
    {{ $slot }}
</button>

    {{-- A primary action button component with hover, focus, and active states.
    
    Props:
    - disabled: Boolean - Whether the button is disabled (default: false)
    
    Example usage:
    <x-primary-button>Save</x-primary-button>
    or with disabled state:
    <x-primary-button :disabled="true">Processing...</x-primary-button>
--}}
