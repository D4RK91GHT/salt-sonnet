@props(['status' => 'info'])

@if (session('status'))
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}>
        {{ session('status') }}
    </div>
@endif

    {{-- Component for displaying authentication status messages.
    
    Props:
    - status: String - The status type (default: 'info')
    
    Example usage:
    <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
