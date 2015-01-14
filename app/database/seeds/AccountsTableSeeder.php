<?php
 
class AccountsTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('accounts')->delete();

        // $formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
        // $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");

        // admin account
        Account::create(array(
            'privileges' => json_encode(array(
                'admin' => true
            )),
            'name' => 'The Admin',
            'username' => 'begborrowshare',
            'password' => Hash::make('begborrowshare'),
            // 'password_confirmation' => Hash::make('begborrowshare'),
            'location' => '',
            'phone' => '',
            'email' => 'admin@example.com',
            'social' => '',
            'last_ip' => '127.0.0.1', // $_SERVER['REMOTE_ADDR']
        ));

        // normal accounts
        $faker = Faker\Factory::create('en_US');
        $faker->seed(8675309);

        for ($i = 1; $i < 100; $i++) {
            $username = $faker->userName;
            $created_at = $faker->dateTimeThisYear;
            Account::create(array(
                'privileges' => json_encode(array(
                    'admin' => false
                )),
                'name' => $faker->name,
                'username' => $username,
                'password' => Hash::make($username),
                // 'password_confirmation' => Hash::make($username),
                'location' => json_encode(array(
                    'street' => $faker->streetAddress,
                    'city' => $faker->city,
                    'region' => $faker->stateAbbr,
                    'postcode' => $faker->postcode,
                    'country' => $faker->countryCode
                )),
                'phone' => $faker->phoneNumber,
                'email' => $username . '@example.com',
                'social' => json_encode(array(
                    'twitter' => '@' . $username,
                )),
                'last_ip' => $faker->ipv4, // $_SERVER['REMOTE_ADDR']
                'created_at' => $created_at,
                'updated_at' => $faker->dateTimeBetween($created_at, new DateTime())
            ));
        }
    } 
}