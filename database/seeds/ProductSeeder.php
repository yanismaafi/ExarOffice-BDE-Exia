<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<2; $i++)
        {
            $faker = Faker\Factory::create();
           
            Product::create([
                 'title' => $faker->sentence(3),
                 'slug' => $faker->slug,
                 'subtitle' => $faker->sentence(5),
                 'description' => $faker->sentence(10),
                 'price' => $faker->numberBetween(1200,40000),
                 'image' => $faker->sentence(10)
            ]);
        }
    }
}
