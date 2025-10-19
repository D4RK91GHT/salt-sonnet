@extends('layouts.web.user-portal.main-layout')

@section('main')
    <!-- Toast for avatar update -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="avatarUpdateToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Your profile picture has been updated successfully.
            </div>
        </div>
    </div>

    <style>
        .hover-shadow {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
        }
    </style>

    <section class="container mt-5 p-3 p-md-4">

        <!-- Settings Tab -->
        <div class="">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body text-center">
                            <div class="position-relative d-inline-block mb-3">
                                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/web/img/avatar.jpg') }}"
                                    class="rounded-circle" width="120" height="120" alt="Profile">
                                <button class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0"
                                    style="width: 36px; height: 36px;"
                                    onclick="document.getElementById('avatarInput').click()">
                                    <i class="fas fa-camera"></i>
                                </button>
                                <input type="file" id="avatarInput" class="d-none" accept="image/*">
                            </div>
                            <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                            <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                            <div class="d-flex justify-content-center gap-2">
                                <span class="badge bg-light text-dark fw-normal">
                                    <i class="fas fa-star text-warning me-1"></i>
                                    {{ Auth::user()->loyalty_tier ?? 'Silver' }} Member
                                </span>
                                <span class="badge bg-light text-dark fw-normal">
                                    <i class="fas fa-award text-primary me-1"></i>
                                    {{ Auth::user()->reward_points ?? '0' }} Points
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="row g-2 mb-4">
                        <!-- Order Stats Card -->
                        <div class="col-12 col-lg-6">
                            <div class="card border-0 shadow-sm h-100 hover-shadow">
                                <div class="card-body py-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                                            <i class="fas fa-shopping-cart text-primary fs-4"></i>
                                        </div>
                                        <div class="text-end">
                                            <p class="text-sm fw-semibold mb-0">Total Orders</p>
                                            <h3 class="fs-6 mb-0">{{ $stats['total_orders'] ?? 0 }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Favorites Card -->
                        <div class="col-12 col-lg-6">
                            <div class="card border-0 shadow-sm h-100 hover-shadow">
                                <div class="card-body py-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="bg-success bg-opacity-10 p-3 rounded-3">
                                            <i class="fas fa-heart text-success fs-4"></i>
                                        </div>
                                        <div class="text-end">
                                            <p class="fw-semibold mb-0">Favorites</p>
                                            <h6 class="mb-0">{{ $stats['favorites_count'] ?? 0 }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="card border-0 shadow-sm mb-2">
                        <div class="card-body d-flex justify-content-between">
                            <h6 class="mb-0">Profile</h6>
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('orders') }}" class="card border-0 shadow-sm mb-2">
                        <div class="card-body d-flex justify-content-between">
                            <h6 class="mb-0">My Orders</h6>
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>
                    <a href="#" class="card border-0 shadow-sm mb-2">
                        <div class="card-body d-flex justify-content-between">
                            <h6 class="mb-0">Wishlist</h6>
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('support') }}" class="card border-0 shadow-sm mb-4">
                        <div class="card-body d-flex justify-content-between">
                            <h6 class="mb-0">Support</h6>
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </a>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="mb-3">Quick Actions</h6>
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action border-0 px-0"
                                    data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <i class="fas fa-lock me-2 text-primary"></i> Change Password
                                </a>
                                <a href="#" class="list-group-item list-group-item-action border-0 px-0">
                                    <i class="fas fa-map-marker-alt me-2 text-primary"></i> Saved Addresses
                                </a>
                                <a href="#" class="list-group-item list-group-item-action border-0 px-0"
                                    data-bs-toggle="modal" data-bs-target="#notificationSettingsModal">
                                    <i class="fas fa-bell me-2 text-primary"></i> Notification Settings
                                </a>
                                <a href="#" class="list-group-item list-group-item-action border-0 px-0"
                                    data-bs-toggle="modal" data-bs-target="#privacySettingsModal">
                                    <i class="fas fa-shield-alt me-2 text-primary"></i> Privacy Settings
                                </a>
                                <a href="#" class="list-group-item list-group-item-action border-0 px-0"
                                    data-bs-toggle="modal" data-bs-target="#referFriendModal">
                                    <i class="fas fa-shield-alt me-2 text-primary"></i> Share App
                                </a>
                            </div>
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
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="loginNotificationsSwitch" checked>
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
                </div>
            </div>
        </div>

    </section>
@endsection

@section('custom-js')
    <script>
        // Order filtering and search functionality
        document.addEventListener('DOMContentLoaded', function() {

            // Handle avatar upload
            const avatarInput = document.getElementById('avatarInput');
            if (avatarInput) {
                avatarInput.addEventListener('change', function(e) {
                    if (this.files && this.files[0]) {
                        const formData = new FormData();
                        formData.append('avatar', this.files[0]);
                        formData.append('_token', '{{ csrf_token() }}');

                        fetch('{{ route('profile.avatar.update') }}', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Update avatar image
                                    const avatarImg = document.querySelector('.user-avatar');
                                    if (avatarImg) {
                                        avatarImg.src = data.avatar_url + '?t=' + new Date().getTime();
                                    }

                                    // Show success message
                                    const toast = new bootstrap.Toast(document.getElementById(
                                        'avatarUpdateToast'));
                                    toast.show();
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }
                });
            }

            // Toggle two-factor authentication
            const twoFactorSwitch = document.getElementById('twoFactorSwitch');
            if (twoFactorSwitch) {
                twoFactorSwitch.addEventListener('change', function() {
                    const isEnabled = this.checked;

                    fetch('{{ route('profile.two-factor.update') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                enabled: isEnabled
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.success) {
                                // Revert switch if update failed
                                this.checked = !isEnabled;
                                alert('Failed to update two-factor authentication settings.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.checked = !isEnabled;
                        });
                });
            }
        });

        // Function to cancel order
        function cancelOrder(orderId) {
            if (confirm('Are you sure you want to cancel this order?')) {
                fetch(`/orders/${orderId}/cancel`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Reload the page to reflect changes
                            window.location.reload();
                        } else {
                            alert(data.message || 'Failed to cancel order. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while processing your request.');
                    });
            }
        }
        // Initialize Bootstrap tabs if needed
        document.addEventListener('DOMContentLoaded', function() {
            var tabEls = [].slice.call(document.querySelectorAll('button[data-bs-toggle="tab"]'));
            tabEls.forEach(function(tabEl) {
                new bootstrap.Tab(tabEl);
            });
        });
    </script>
@endsection
