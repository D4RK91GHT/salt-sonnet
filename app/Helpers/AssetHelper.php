<?php

if (!function_exists('admin_asset')) {
    function admin_asset($path) {
        return asset('assets/admin/' . ltrim($path, '/'));
    }
}
