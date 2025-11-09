@extends('layouts.web.user-portal.main-layout')

@section('main')
    <div class="container px-3 px-md-4">

        <!-- Update Password Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <x-web.profile.update-password-form />
            </div>
        </div>

    </div>
@endsection
