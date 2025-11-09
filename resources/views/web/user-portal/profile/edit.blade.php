@extends('layouts.web.user-portal.main-layout')

@section('main')
    <div class="container px-3 px-md-4">

        <!-- Profile Information Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <x-web.profile.update-profile-information-form :user="$user" />
            </div>
        </div>

        <!-- Preferences Card -->
        <div class="card shadow-sm mb-4">
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

    </div>
@endsection
