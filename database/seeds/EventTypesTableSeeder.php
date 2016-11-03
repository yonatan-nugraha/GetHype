<?php

use Illuminate\Database\Seeder;

use App\EventType;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$event_types = ['Conference', 'Festival', 'Seminar', 'Class', 'Concert', 'Competition'];

    	foreach(range(0, 5) as $i) {
	        EventType::create([
	        	'name' 		=> $event_types[$i],
	            'description'  => 'Lorem Ipsum',
	            'slug'      => str_slug($event_types[$i], '-'),
	            'status'    => 1,
	        ]);
	    }
    }
}
