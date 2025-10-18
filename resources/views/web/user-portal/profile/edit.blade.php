@extends('layouts.web.user-portal.main-layout')

@section('main')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
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
