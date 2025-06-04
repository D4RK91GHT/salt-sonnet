<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeeklyNewsletter;

class SendWeeklyEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-weekly-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly emails to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new WeeklyNewsletter($user));
        }

        $this->info('Weekly emails sent successfully!');
    }
}
