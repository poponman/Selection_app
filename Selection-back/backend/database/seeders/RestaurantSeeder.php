<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Restaurant::create([
            'name' => 'Sample Restaurant',
            'address' => '123 Sample Street',
            'opening_hours' => '10:00 - 22:00',
            'phone' => '123-456-7890',
            'budget' => 3000,
        ]);
    
    }
}
