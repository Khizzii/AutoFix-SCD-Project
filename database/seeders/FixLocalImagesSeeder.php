<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixLocalImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            'Continental GP5000 Tire' => 'continental_tire.png',
            'Brooks B17 Leather Saddle' => 'brooks_saddle.png',
            'Shimano 105 Rear Derailleur' => 'shimano_derailleur.png',
            'Mavic Alloy Wheelset' => 'mavic_wheelset.png',
            'Aluminum Drop Handlebar' => 'drop_handlebar.png',
            'Shimano Ultegra Chain' => 'shimano_chain.png', // Assuming this exists or will exist
        ];

        foreach ($products as $name => $image) {
            DB::table('products')
                ->where('name', $name)
                ->update(['image' => $image]);
        }
    }
}
