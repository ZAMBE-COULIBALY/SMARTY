<?php

use App\VocabularyType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VocabularySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('vocabularies')->insert(
            [
                'code' => 'ELM',
                'label' => 'ELECTROMENAGER',
                "type_id" => VocabularyType::where("code","PDT-TYP")->first()->id,
                "created_at" => now()
            ]);
    }
}
