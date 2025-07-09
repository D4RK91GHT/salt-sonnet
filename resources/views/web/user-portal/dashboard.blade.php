@extends('layouts.web.user-portal.main-layout')

@section('main')
<section class="container mt-5 p-4">
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
                Profile
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
            <h2 class="h4 mb-3">Profile Information</h2>
            <p class="text-muted">Your profile details will appear here.</p>
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
