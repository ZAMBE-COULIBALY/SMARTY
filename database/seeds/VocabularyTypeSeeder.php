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
            'label' => 'TYPE PRODUIT',
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
                'label' => 'MARQUE',
                'parent' => VocabularyType::all()->where("code","PDT-KIND")->first()->id,
            ]);

            DB::table('vocabularytypes')->insert(
                [
                    'code' => 'PDT-MDL',
                    'label' => 'MODELE',
                    'parent' => VocabularyType::all()->where("code","PDT-LBL")->first()->id,
                    "created_at" => now()
                    ]);
    }
}
