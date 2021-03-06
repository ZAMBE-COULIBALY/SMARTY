<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $date = new Carbon();
        DB::table('users')->insert([
            'name' => 'Admin Smarty',
            'username' => 'adminsmarty',
            'email' => 'armandperise@gmail.com',
            'password' => Hash::make('Nsia2020'),
            'slug' => Str::slug('adminsmarty'.$date->format('dmYhis')),
            'state' => true,

        ]);

        DB::table('users')->insert([
            'name' => 'Sinitre MANAGER',
            'username' => 'claimsmanager',
            'email' => 'armandperise@gmail.com',
            'password' => Hash::make('Nsia2020'),
            'slug' => Str::slug('claimsmanager'.$date->format('dmYhis')),
            'state' => true,

        ]);
    }
}
