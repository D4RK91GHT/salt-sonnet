@props(['type' => 'button'])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

    {{-- A danger button component for delete or destructive actions.
    
    Props:
    - type: String - The button type (default: 'button')
    
    Example usage:
    <x-danger-button type="submit">
        Delete Account
    </x-danger-button> --}}
