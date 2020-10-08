<?php

use App\VocabularyType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
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
                "attribute" => json_encode(["ASS-TYP" => "FULL"]),
                "created_at" => now()
            ]);

    }
}
