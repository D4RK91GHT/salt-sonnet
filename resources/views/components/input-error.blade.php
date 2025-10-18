@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif


    {{-- This component displays validation error messages in a styled list.
    
    Props:
    - messages: Array|string - The error message(s) to display
    
    Example usage:
    <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
