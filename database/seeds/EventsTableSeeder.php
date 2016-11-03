<?php

use Illuminate\Database\Seeder;

use Faker\Factory;
use App\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Factory::create();

    	foreach(range(0, 5) as $i) {
    		$name = $faker->sentence(mt_rand(3, 4));

	        Event::create([
	        	'name' 		=> ucwords($name),
	            'description'  	=> $faker->paragraph(mt_rand(12, 17)),
	            'category_id' 	=> mt_rand(1, 6),
	            'event_type_id' => mt_rand(1, 6),
	            'user_id' 	=> 1,
	            'location' 	=> 'Pullman Hotel, Jakarta',
	            'started_at' => '2016-09-11 12:00:00',
	            'ended_at' 	=> '2016-12-11 11:59:59',
	            'subject_discussion' => $faker->paragraph(mt_rand(12, 17)),
	            'video_url' => 'https://www.youtube.com/embed/4OrCA1OInoo',
	            'slug'      => str_slug($name, '-') . '-' . sprintf("%s", mt_rand(10000, 99999)),
	            'status'    => 1,
	        ]);
	    }
    }
}
