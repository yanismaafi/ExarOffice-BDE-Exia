<?php

use App\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<6; $i++)
        {
            $faker = Faker\Factory::create();
           
            Event::create([
                 'name' => $faker->sentence(3),
                 'slug' => $faker->slug,
                 'date' => $faker->date,
                 'description' => $faker->sentence(10),
                 'image' => $faker->sentence(10),
                 'nbrPlaces' => 20
            ]);
        }
    }
}
