<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClaimsManagerSeeder extends Seeder
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

        DB::table('claimsManagers')->insert([
            'code' => "AJC42",
            'lastname' => 'MANAGER',
            'firstname' => 'Sinistres',
            'username' => 'claimsmanager',
            'contact' => '01010101',
            'slug' => Str::slug('claimsmanager'.$date->format('dmYhis')),
            'state' => true,

        ]);
    }
}
