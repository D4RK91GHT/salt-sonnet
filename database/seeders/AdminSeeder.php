<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'email' => 'admin@admin.com',
            'fname' => 'Super',
            'lname' => 'Admin',
            'password' => bcrypt('12345678'),
        ]);
    }
}
