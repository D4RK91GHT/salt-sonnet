@props(['value' => null])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>


{{-- This component provides a styled label for form inputs with dark mode support.
    
    Props:
    - value: String - The label text (can also be passed as slot content)
    
    Example usage:
    <x-input-label for="email" value="Email Address" />
    or
    <x-input-label for="email">Email Address</x-input-label> --}}
