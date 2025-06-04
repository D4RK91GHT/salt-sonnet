<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeeklyNewsletter;
use App\Jobs\SendWeeklyNewsletter;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Add this route
// Route::get('/send-weekly-emails', function() {
//     $users = User::all();
    
//     foreach ($users as $user) {
//         Mail::to($user->email)->send(new WeeklyNewsletter($user));
//     }
    
//     return 'Weekly emails sent successfully!';
// })->middleware('web');

// routes/console.php
Route::get('/send-weekly-emails', function() {
    SendWeeklyNewsletter::dispatch();
    return 'Weekly newsletter job has been queued!';
});

Route::get('/test-email-view', function() {
    return view('emails.test', ['user' => \App\Models\User::first()]);
});