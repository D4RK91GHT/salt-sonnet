@extends('layouts.web.user-portal.main-layout')

@section('main')
    <div class="container mt-5 p-3 p-md-4">
        <div class="d-flex mt-5">
            <button class="btn btn-secondary btn-sm" onclick="window.location.href = '{{ route('dashboard') }}'">Back to
                Dashboard</button>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <!-- Profile Information Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <x-web.profile.update-profile-information-form :user="$user" />
                    </div>
                </div>

                <!-- Update Password Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <x-web.profile.update-password-form />
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <!-- Preferences Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Dietary Preferences</h5>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                data-bs-target="#dietaryPreferencesModal">
                                <i class="fas fa-edit me-1"></i> Edit
                            </button>
                        </div>

                        <div class="mb-4">
                            <h6 class="small text-muted mb-2">Dietary Restrictions</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $dietaryRestrictions = Auth::user()->dietary_restrictions ?? [];
                                    $dietaryIcons = [
                                        'vegetarian' => 'carrot',
                                        'vegan' => 'leaf',
                                        'gluten_free' => 'bread-slice',
                                        'dairy_free' => 'cheese',
                                        'nut_free' => 'peanut',
                                        'halal' => 'mosque',
                                        'kosher' => 'star-of-david',
                                    ];

                                    $displayed = [];
                                @endphp

                                @foreach ($dietaryRestrictions as $restriction)
                                    @if (isset($dietaryIcons[$restriction]) && !in_array($restriction, $displayed))
                                        <span class="badge bg-light text-dark p-2">
                                            <i class="fas fa-{{ $dietaryIcons[$restriction] }} text-primary me-1"></i>
                                            {{ ucwords(str_replace('_', ' ', $restriction)) }}
                                        </span>
                                        @php $displayed[] = $restriction; @endphp
                                    @endif
                                @endforeach

                                @if (empty($dietaryRestrictions))
                                    <p class="text-muted small mb-0">No dietary restrictions specified</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-0">
                            <h6 class="small text-muted mb-2">Favorite Cuisines</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @php
                                    $favoriteCuisines = Auth::user()->favorite_cuisines ?? [];
                                    $cuisineIcons = [
                                        'italian' => 'pizza-slice',
                                        'chinese' => 'drumstick-bite',
                                        'indian' => 'pepper-hot',
                                        'mexican' => 'pepper',
                                        'japanese' => 'fish',
                                        'thai' => 'lemon',
                                        'american' => 'hamburger',
                                        'mediterranean' => 'olive-branch',
                                    ];

                                    $displayedCuisines = [];
                                @endphp

                                @foreach ($favoriteCuisines as $cuisine)
                                    @if (isset($cuisineIcons[$cuisine]) && !in_array($cuisine, $displayedCuisines))
                                        <span class="badge bg-light text-dark p-2">
                                            <i class="fas fa-{{ $cuisineIcons[$cuisine] }} text-primary me-1"></i>
                                            {{ ucfirst($cuisine) }}
                                        </span>
                                        @php $displayedCuisines[] = $cuisine; @endphp
                                    @endif
                                @endforeach

                                @if (empty($favoriteCuisines))
                                    <p class="text-muted small mb-0">No favorite cuisines selected</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Security Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-4">Security</h5>

                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <div>
                                <h6 class="mb-0">Two-Factor Authentication</h6>
                                <p class="small text-muted mb-0">Add an extra layer of security to your account</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="twoFactorSwitch"
                                    {{ Auth::user()->two_factor_enabled ? 'checked' : '' }}>
                                <label class="form-check-label" for="twoFactorSwitch"></label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <div>
                                <h6 class="mb-0">Login Notifications</h6>
                                <p class="small text-muted mb-0">Get notified when someone logs into your account</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="loginNotificationsSwitch"
                                    checked>
                                <label class="form-check-label" for="loginNotificationsSwitch"></label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">Account Activity</h6>
                                <p class="small text-muted mb-0">Last login:
                                    {{ Auth::user()->last_login_at ? Auth::user()->last_login_at->diffForHumans() : 'Never' }}
                                </p>
                            </div>
                            <a href="#" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#accountActivityModal">
                                View Activity
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Delete Account Card -->
                <div class="card border-danger shadow-sm">
                    <div class="card-body p-4">
                        <x-web.profile.delete-user-form />
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
