<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <h2 class="h5 mb-2">{{ __('Update Password') }}</h2>
            <p class="text-muted small">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </div>

        <form method="post" action="{{ route('password.update') }}" class="needs-validation" novalidate>
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
                <input type="password" 
                       class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                       id="update_password_current_password" 
                       name="current_password" 
                       autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
                <input type="password" 
                       class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                       id="update_password_password" 
                       name="password" 
                       autocomplete="new-password">
                @error('password', 'updatePassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input type="password" 
                       class="form-control" 
                       id="update_password_password_confirmation" 
                       name="password_confirmation" 
                       autocomplete="new-password">
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save') }}
                </button>

                @if (session('status') === 'password-updated')
                    <div class="text-success" id="password-save-message">
                        {{ __('Saved.') }}
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Auto-hide success message after 2 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const saveMessage = document.getElementById('password-save-message');
        if (saveMessage) {
            setTimeout(() => {
                saveMessage.style.display = 'none';
            }, 2000);
        }
    });
</script>
@endpush