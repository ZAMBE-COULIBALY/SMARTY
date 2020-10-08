<?php

use App\Vocabulary;
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
                "attribute" => json_encode(["ASS-TYP" => "FULL"]),
                "created_at" => now()
            ]);

        DB::table('vocabularies')->insert(
            [
                'code' => 'ELC-100',
                'label' => 'ELECTRONIQUE 100',
                "type_id" => VocabularyType::where("code","PDT-TYP")->first()->id,
                "attribute" => json_encode(["ASS-TYP" => "FULL"]),
                "created_at" => now()
            ]);

        DB::table('vocabularies')->insert(
            [
                'code' => 'ELC-DP',
                'label' => 'ELECTRONIQUE DP',
                "type_id" => VocabularyType::where("code","PDT-TYP")->first()->id,
                "attribute" => json_encode(["ASS-TYP" => "DP"]),
                "created_at" => now()
            ]);

        DB::table('vocabularies')->insert(
            [
                'code' => 'SMT',
                'label' => 'SMARTPHONE',
                "type_id" => VocabularyType::where("code","PDT-KIND")->first()->id,
                "parent" => Vocabulary::where("code","ELC-DP")->first()->id,
                "attribute" => json_encode(["CLM-TYP" => ["BE","OX","PML"]]),
                "created_at" => now()
            ]);

        DB::table('vocabularies')->insert(
            [
                'code' => 'TAB',
                'label' => 'TABLETTE',
                "type_id" => VocabularyType::where("code","PDT-KIND")->first()->id,
                "parent" => Vocabulary::where("code","ELC-DP")->first()->id,
                "attribute" => json_encode(["CLM-TYP" => ["BE","OX","PML"]]),
                "created_at" => now()
            ]);

        DB::table('vocabularies')->insert(
            [
                'code' => 'WIFI',
                'label' => 'ROUTEUR WIFI',
                "type_id" => VocabularyType::where("code","PDT-KIND")->first()->id,
                "parent" => Vocabulary::where("code","ELC-100")->first()->id,
                "attribute" => json_encode(["CLM-TYP" => ["OX","PML","PE"]]),
                "created_at" => now()
            ]);

        DB::table('vocabularies')->insert(
            [
                'code' => 'BE',
                'label' => "BRIS D'ECRAN",
                "type_id" => VocabularyType::where("code","CLM-TYP")->first()->id,
                "created_at" => now()
            ]);

        DB::table('vocabularies')->insert(
            [
            'code' => 'OX',
            'label' => "OXYDATION",
            "type_id" => VocabularyType::where("code","CLM-TYP")->first()->id,
            "created_at" => now()
            ]);
        DB::table('vocabularies')->insert(
            [
            'code' => 'PML',
            'label' => "PANNE MECANIQUE ET LOGICIELLE",
            "type_id" => VocabularyType::where("code","CLM-TYP")->first()->id,
            "created_at" => now()
            ]);
        DB::table('vocabularies')->insert(
            [
            'code' => 'PE',
            'label' => "PANNE ELECTRIQUE",
            "type_id" => VocabularyType::where("code","CLM-TYP")->first()->id,
            "created_at" => now()
            ]);
        DB::table('vocabularies')->insert(
            [
            'code' => 'INC',
            'label' => "INCENDIE",
            "type_id" => VocabularyType::where("code","CLM-TYP")->first()->id,
            "created_at" => now()
            ]);
        DB::table('vocabularies')->insert(
            [
            'code' => 'DOM-ELEC',
            'label' => "DOMMAGE ELECTRIQUE",
            "type_id" => VocabularyType::where("code","CLM-TYP")->first()->id,
            "created_at" => now()
            ]);
        DB::table('vocabularies')->insert(
            [
            'code' => 'DEG-EAU',
            'label' => "DEGATS DES EAUX",
            "type_id" => VocabularyType::where("code","CLM-TYP")->first()->id,
            "created_at" => now()
            ]);
        DB::table('vocabularies')->insert(
            [
            'code' => 'BA',
            'label' => "BRIS ACCIDENTELS",
            "type_id" => VocabularyType::where("code","CLM-TYP")->first()->id,
            "created_at" => now()
            ]);

        DB::table('vocabularies')->insert(
            [
            'code' => 'VDE',
            'label' => "VOL A DOMICILE AVEC EFFRACTION ET/OU HOLDUP",
            "type_id" => VocabularyType::where("code","CLM-TYP")->first()->id,
            "created_at" => now()
            ]);

        DB::table('vocabularies')->insert(
            [
            'code' => 'FULL',
            'label' => "ENTIERE",
            "type_id" => VocabularyType::where("code","ASS-TYP")->first()->id,
            "created_at" => now()
            ]);

        DB::table('vocabularies')->insert(
            [
            'code' => 'DP',
            'label' => "DEPRECIATIVE",
            "type_id" => VocabularyType::where("code","ASS-TYP")->first()->id,
            "created_at" => now()
            ]);
    }
}
