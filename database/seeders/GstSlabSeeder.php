<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GSTSlab;

class GstSlabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slabs = [
            [
                'percentage' => 0,
                'description' => 'Exempt / Nil',
            ],
            [
                'percentage' => 5,
                'description' => 'Reduced Rate',
            ],
            [
                'percentage' => 12,
                'description' => 'Standard Rate',
            ],
            [
                'percentage' => 18,
                'description' => 'General Rate',
            ],
            [
                'percentage' => 28,
                'description' => 'Luxury Rate',
            ],
        ];

        foreach ($slabs as $slab) {
            GSTSlab::updateOrCreate([
                'percentage' => $slab['percentage']
            ], $slab);
        }
    }
}
