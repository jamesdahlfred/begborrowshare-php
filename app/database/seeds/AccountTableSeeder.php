<?php
 
class AccountTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('accounts')->delete();
 
        Account::create(array(
            'privileges' => '',
            'name' => 'First User',
            'username' => 'firstuser',
            'password' => Hash::make('first_password'),
            'location' => '',
            'phone' => '',
            'email' => 'firstuser@example.com',
            'social' => '',
            'last_ip' => $_SERVER['REMOTE_ADDR']
        ));
 
        Account::create(array(
            'privileges' => '',
            'name' => 'Second User',
            'username' => 'seconduser',
            'password' => Hash::make('second_password'),
            'location' => '',
            'phone' => '',
            'email' => 'seconduser@example.com',
            'social' => '',
            'last_ip' => $_SERVER['REMOTE_ADDR']
        ));

        Account::create(array(
            'privileges' => '',
            'name' => 'Third User',
            'username' => 'thirduser',
            'password' => Hash::make('third_password'),
            'location' => '',
            'phone' => '',
            'email' => 'thirduser@example.com',
            'social' => '',
            'last_ip' => $_SERVER['REMOTE_ADDR']
        ));
    } 
}