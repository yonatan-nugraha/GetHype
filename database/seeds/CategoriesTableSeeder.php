<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Food & Beverages', 'Music', 'Sport', 'Nightlife', 'Education', 'Health'];

    	foreach(range(0, 5) as $i) {
	        Category::create([
	        	'name' 		=> $categories[$i],
	            'description'  => 'Lorem Ipsum',
	            'slug'      => str_slug($categories[$i], '-'),
	            'status'    => 1,
	        ]);
	    }
    }
}
