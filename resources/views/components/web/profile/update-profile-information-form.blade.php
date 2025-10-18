<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <h2 class="h5 mb-2">{{ __('Profile Information') }}</h2>
            <p class="text-muted small">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </div>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="needs-validation" novalidate>
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
                       required 
                       autofocus 
                       autocomplete="name">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}" 
                       required 
                       autocomplete="username">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="alert alert-warning mt-2">
                        <p class="mb-1">{{ __('Your email address is unverified.') }}</p>
                        <button form="send-verification" class="btn btn-sm btn-outline-warning">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                        @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success mt-2 mb-0">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <div class="text-success" id="save-message">
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
        const saveMessage = document.getElementById('save-message');
        if (saveMessage) {
            setTimeout(() => {
                saveMessage.style.display = 'none';
            }, 2000);
        }
    });
</script>
@endpush