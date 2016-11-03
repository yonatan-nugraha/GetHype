<?php

use Illuminate\Database\Seeder;

use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(EventTypesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(JournalsTableSeeder::class);
        $this->call(CollectionsTableSeeder::class);
    }
}
