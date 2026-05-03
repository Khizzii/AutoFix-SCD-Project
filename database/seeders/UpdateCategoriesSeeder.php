<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            'Continental GP5000 Tire' => 'Wheels & Tires',
            'Brooks B17 Leather Saddle' => 'Seating',
            'Shimano 105 Rear Derailleur' => 'Drivetrain',
            'Mavic Alloy Wheelset' => 'Wheels & Tires',
            'Aluminum Drop Handlebar' => 'Steering',
            'Shimano Ultegra Chain' => 'Drivetrain',
        ];

        foreach ($products as $name => $category) {
            DB::table('products')
                ->where('name', $name)
                ->update(['category' => $category]);
        }
    }
}
