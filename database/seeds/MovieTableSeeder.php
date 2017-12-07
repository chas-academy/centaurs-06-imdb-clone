<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('movies')->insert([
            'title' => $faker->word,
            'plot' => $faker->paragraph,
            'playtime' => $faker->numberBetween(70, 360),
            'poster' => $faker->domainName,
            'backdrop' => $faker->domainName,
            'releasedate' => $faker->date,
            'imdb_rating' => $faker->numberBetween(1, 10),
            'chas_rating' => $faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
