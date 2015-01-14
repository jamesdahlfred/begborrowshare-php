<?php
 
class SharesTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('shares')->delete();

        $faker = Faker\Factory::create('en_US');
        $faker->seed(8675309);

        // Add one to include admin
        for ($i = 0; $i < 100; $i++) {
            $num_begs = mt_rand(0, 10);
            for ($j = 0; $j < $num_begs; $j++) {
                $title = $faker->sentence(mt_rand(1, 5));
                $created_at = $faker->dateTimeThisYear;
                $claimed = mt_rand(0, 1) ? false : true;
                $claimed_at = $claimed ? $faker->dateTimeBetween($created_at, new DateTime()) : 'NULL';
                Share::create(array(
                    'sharer' => $i + 2,
                    'receiver' => $claimed ? mt_rand(2, 102) : 'NULL',
                    'private' => mt_rand(0, 1) ? true : false,
                    'title' => substr($title, 0, strlen($title) - 1),
                    'description' => $faker->text(mt_rand(50, 500)),
                    'categories' => json_encode($faker->words(mt_rand(0, 5))),
                    'claimed_at' => $claimed_at,
                    'expires_at' => $claimed ? $faker->dateTimeBetween($claimed_at, new DateTime()) : 'NULL',
                    'created_at' => $created_at,
                    'updated_at' => $faker->dateTimeBetween($created_at, new DateTime())
                ));
            }
        }
    } 

    // $table->increments('id');
    // $table->integer('sharer')->unsigned();
    // $table->integer('receiver')->unsigned();
    // $table->boolean('private');
    // $table->string('title');
    // $table->text('description');
    // $table->string('categories')->nullable();
    // $table->dateTime('claimed_at');
    // $table->dateTime('expires_at');
    // // $table->dateTime('created_at');
    // // $table->dateTime('updated_at');
    // $table->timestamps();
    // // $table->dateTime('deleted_at');
    // $table->softDeletes();
    // $table->foreign('sharer')->references('id')->on('accounts');
    // $table->foreign('receiver')->references('id')->on('accounts');

}