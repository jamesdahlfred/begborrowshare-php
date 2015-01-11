<?php
 
class ThingsTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('things')->delete();

        $faker = Faker\Factory::create('en_US');
        $faker->seed(9141705);

        // Add one to include admin
        for ($i = 0; $i < 100; $i++) {
            $num_things = mt_rand(0, 25);
            for ($j = 0; $j < $num_things; $j++) {
                $title = $faker->sentence(mt_rand(1, 5));
                Thing::create(array(
                    'owner' => $i + 2,
                    'possessor' => $i + 2,
                    'location' => json_encode(array(
                        'street' => $faker->streetAddress,
                        'city' => $faker->city,
                        'region' => $faker->stateAbbr,
                        'postcode' => $faker->postcode,
                        'country' => $faker->countryCode
                    )),
                    'title' => substr($title, 0, strlen($title) - 1),
                    'description' => $faker->text(mt_rand(50, 500)),
                    'tags' => json_encode($faker->words(mt_rand(0, 5))),
                    'specs' => '',
                    'images' => '',
                    'created_at' => $faker->dateTimeThisYear,
                    'updated_at' => $faker->dateTimeBetween($faker->dateTimeThisYear, new DateTime())
                ));
            }
        }
    } 
}