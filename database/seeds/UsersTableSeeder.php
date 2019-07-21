<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Paweł',
        	'email' => 'pawelgrunwald@spoko.pl',
        	'password' => bcrypt('765uyt4321P/'),
        	'type' => 'admin'
        ]);
        DB::table('users')->insert([
        	'name' => 'test',
        	'email' => 'test@test.pl',
        	'password' => bcrypt('password'),
        	'type' => 'user'
        ]);
        DB::table('users')->insert([
            'name' => 'test2',
            'email' => 'test2@test2.pl',
            'password' => bcrypt('password'),
            'type' => 'user'
        ]);
    }
}
