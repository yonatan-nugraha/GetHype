<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'first_name' => 'Yonatan',
            'last_name'  => 'Nugraha',
            'email'      => 'yonatan.nugraha@gethype.co.id',
            'phone'      => '081932058111',
            'gender'     => 1,
            'birthdate'  => '1993-05-22',
            'password'   => bcrypt('123456'),
            'status'     => 1,
        ]);

        User::create([
        	'first_name' => 'Celine',
            'last_name'  => 'Evelina',
            'email'      => 'celine.evelina@gethype.co.id',
            'phone'      => '081273627555',
            'gender'     => 2,
            'birthdate'  => '1997-11-7',
            'password'   => bcrypt('123456'),
            'status'     => 1,
        ]);
    }
}
