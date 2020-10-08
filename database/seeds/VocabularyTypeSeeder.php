<?php

use App\VocabularyType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VocabularyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('vocabularytypes')->insert(
            [
            'code' => 'PDT-TYP',
            'label' => 'TYPE DE PRODUIT',
            "created_at" => now()
            ]
        );
        DB::table('vocabularytypes')->insert(
        [
            'code' => 'PDT-KIND',
            'label' => 'PRODUIT',
            'parent' => VocabularyType::all()->where("code","PDT-TYP")->first()->id,
        ]);

        DB::table('vocabularytypes')->insert(
            [
                'code' => 'PDT-LBL',
                'label' => 'MARQUE DE PRODUIT',
                'parent' => VocabularyType::all()->where("code","PDT-KIND")->first()->id,
            ]);

        DB::table('vocabularytypes')->insert(
                [
                    'code' => 'PDT-MDL',
                    'label' => 'MODELE DE PRODUIT',
                    'parent' => VocabularyType::all()->where("code","PDT-LBL")->first()->id,
                    "created_at" => now()
                ]);

        DB::table('vocabularytypes')->insert(
            [
                'code' => 'ASS-TYP',
                'label' => "TYPE D'ASSURANCE",
                "created_at" => now()
            ]);

        DB::table('vocabularytypes')->insert(
            [
                'code' => 'CLM-TYP',
                'label' => 'TYPE DE SINISTRE',
                "created_at" => now()
            ]);
    }
}
