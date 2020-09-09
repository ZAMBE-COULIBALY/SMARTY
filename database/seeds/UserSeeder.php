<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $date = new DateTime(null);
        DB::table('users')->insert([
            'name' => 'Admin Smarty',
            'username' => 'adminsmarty',
            'email' => 'armandperise@gmail.com',
            'password' => Hash::make('password'),
            'slug' => Str::slug('adminsmarty'.$date->format('dmYhis')),
            'state' => true,

        ]);
    }
}
