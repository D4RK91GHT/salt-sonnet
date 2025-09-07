<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemVariationType;

class VariationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Size',
                'description' => 'Select a size option such as Small, Medium, or Large.',
                'is_required' => true,
                'display_order' => 1,
            ],
            [
                'name' => 'Flavor',
                'description' => 'Choose which flavor you would like.',
                'is_required' => false,
                'display_order' => 2,
            ],
            [
                'name' => 'Add-ons',
                'description' => 'Optional add-ons like extra cheese, toppings, or sides.',
                'is_required' => false,
                'display_order' => 3,
            ],
        ];

        foreach ($types as $type) {
            ItemVariationType::updateOrCreate(
                ['name' => $type['name']],
                $type
            );
        }
    }
}
