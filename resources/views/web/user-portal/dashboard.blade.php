@extends('layouts.web.user-portal.main-layout')

@section('main')
<style>
    .order-card {
        transition: all 0.3s ease-in-out;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid transparent;
        position: relative;
    }
    .order-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 10px;
        padding: 1px;
        background: linear-gradient(135deg, #0d6efd, transparent);
        -webkit-mask: 
            linear-gradient(#fff 0 0) content-box, 
            linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        pointer-events: none; /* This ensures clicks pass through to elements below */
        z-index: 0; /* Lower z-index than card content */
    }
    
    /* Ensure card content is above the pseudo-element */
    .order-card > * {
        position: relative;
        z-index: 1;
    }
    .order-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(13, 110, 253, 0.1) !important;
    }
    .order-card:hover::before {
        opacity: 1;
    }
    .status-badge {
        font-size: 0.75rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        padding: 0.35rem 0.75rem;
    }
</style>

<section class="container mt-5 p-3 p-md-4">
    <div class="d-flex justify-content-between flex-wrap mb-4">
        <h3>Dashboard</h3>
        <div>
            <a href="#" class="btn btn-outline-primary btn-sm">Edit Profile</a>
        </div>
    </div>
    
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-0" id="dashboardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                Orders
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                Dashboard
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">
                Settings
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">
                Contacts
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link disabled" disabled>Disabled</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content p-3 border border-top-0 rounded-bottom bg-white" style="min-height: 65vh">
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            {{-- <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <button class="btn btn-sm btn-outline-secondary me-2">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-download me-1"></i> Export
                    </button>
                </div>
            </div> --}}

            @if(isset($orders) && count($orders) > 0)
                @foreach($orders as $order)
                <div class="card border-0 shadow-sm mb-4 order-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-1">#{{ $order->id }}</h5>
                                <p class="text-muted small mb-0">
                                    Placed 
                                    @if ($order->updated_at->isToday())
                                        {{ $order->updated_at->diffForHumans() }}
                                    @else
                                        on {{ $order->created_at->format('F d, Y') }}
                                    @endif
                                </p>
                            </div>
                            <span class="badge rounded-pill status-badge bg-{{ 
                                $order->status == 'completed' ? 'success' : 
                                ($order->status == 'processing' ? 'primary' : 
                                ($order->status == 'cancelled' ? 'danger' : 'warning'))
                            }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        
                        <div class="row align-items-center mb-3">
                            <div class="col-md-4">
                                @foreach($orders as $order)
                                    <div class="d-flex gap-2 gap-lg-3 gap-xl-4 gap-xxl-5 justify-content-start">
                                        @foreach ($order->items as $eachitem)
                                            <img class="rounded w-25" src="{{ asset('storage/' . $eachitem->menuItem->primaryImage->image_path) }}" alt="">
                                            @if($loop->iteration == 4)
                                                @break
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-eye me-1"></i> View Details
                            </a>
                            {{-- @if($order->status == 'pending')
                            <button class="btn btn-outline-danger btn-sm" onclick="cancelOrder({{ $order->id }})">
                                <i class="fas fa-times me-1"></i> Cancel Order
                            </button>
                            @endif --}}
                        </div>
                    </div>
                </div>
                @endforeach
                {{ $orders->links('pagination::bootstrap-5') }}
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-shopping-bag fa-3x text-muted"></i>
                    </div>
                    <h5>No orders yet</h5>
                    <p class="text-muted">You haven't placed any orders yet.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Browse Menu</a>
                </div>
            @endif
        </div>

        <div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <h2 class="h4 mb-3">Dashboard Overview</h2>
            <p class="text-muted">Your dashboard content will appear here.</p>
        </div>

        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <h2 class="h4 mb-3">Account Settings</h2>
            <p class="text-muted">Your settings will appear here.</p>
        </div>

        <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <h2 class="h4 mb-3">Contact Information</h2>
            <p class="text-muted">Your contact details will appear here.</p>
        </div>
    </div>
</section>
@endsection

@section('custom-js')
<!-- Bootstrap JS and dependencies are already included in your layout -->
<script>
    // Initialize Bootstrap tabs if needed
    document.addEventListener('DOMContentLoaded', function() {
        var tabEls = [].slice.call(document.querySelectorAll('button[data-bs-toggle="tab"]'));
        tabEls.forEach(function(tabEl) {
            new bootstrap.Tab(tabEl);
        });
    });
</script>
@endsection
