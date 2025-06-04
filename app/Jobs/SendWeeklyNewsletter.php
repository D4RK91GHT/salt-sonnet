<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeeklyNewsletter;

class SendWeeklyNewsletter implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::all();
        
        foreach ($users as $user) {
            Mail::to($user->email)->queue(new WeeklyNewsletter($user));
        }
    }
}
