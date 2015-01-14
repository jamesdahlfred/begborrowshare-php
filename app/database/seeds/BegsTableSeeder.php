<?php
 
class BegsTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('begs')->delete();

        $faker = Faker\Factory::create('en_US');
        $faker->seed(8675309);

        // Add one to include admin
        for ($i = 0; $i < 100; $i++) {
            $num_begs = mt_rand(0, 10);
            for ($j = 0; $j < $num_begs; $j++) {
                $title = $faker->sentence(mt_rand(1, 5));
                $created_at = $faker->dateTimeThisYear;
                $fulfilled = mt_rand(0, 1) ? false : true;
                $fulfilled_at = $fulfilled ? $faker->dateTimeBetween($created_at, new DateTime()) : 'NULL';
                Beg::create(array(
                    'beggar' => $i + 2,
                    'benefactor' => $fulfilled ? mt_rand(2, 102) : 'NULL',
                    'private' => mt_rand(0, 1) ? true : false,
                    'title' => substr($title, 0, strlen($title) - 1),
                    'description' => $faker->text(mt_rand(50, 500)),
                    'categories' => json_encode($faker->words(mt_rand(0, 5))),
                    'location' => json_encode(array(
                        'street' => $faker->streetAddress,
                        'city' => $faker->city,
                        'region' => $faker->stateAbbr,
                        'postcode' => $faker->postcode,
                        'country' => $faker->countryCode
                    )),
                    'fulfilled_at' => $fulfilled_at,
                    'expires_at' => $fulfilled ? $faker->dateTimeBetween($fulfilled_at, new DateTime()) : 'NULL',
                    'created_at' => $created_at,
                    'updated_at' => $faker->dateTimeBetween($created_at, new DateTime())
                ));
            }
        }
    } 

    // $table->increments('id');
    // $table->integer('beggar')->unsigned();
    // $table->integer('benefactor')->unsigned();
    // $table->boolean('private');
    // $table->string('title');
    // $table->text('description');
    // $table->string('categories')->nullable();
    // $table->string('location');
    // $table->dateTime('fulfilled_at');
    // $table->dateTime('expires_at');
    // // $table->dateTime('created_at');
    // // $table->dateTime('updated_at');
    // $table->timestamps();
    // // $table->dateTime('deleted_at');
    // $table->softDeletes();
    // $table->foreign('beggar')->references('id')->on('accounts');
    // $table->foreign('benefactor')->references('id')->on('accounts');

}