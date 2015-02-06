<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		$this->call('AccountsTableSeeder');
		$this->call('ThingsTableSeeder');
		$this->call('BegsTableSeeder');
		$this->call('SharesTableSeeder');

    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

}
