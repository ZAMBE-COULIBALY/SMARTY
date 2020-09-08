<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVocabularyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vocabularytypes', function (Blueprint $table) {
            $table->id();

            $table->string("label");
            $table->unsignedBigInteger('parent')->default(0);
            $table->foreign('parent')->references('id')->on('vocabularytypes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vocabulary_types');
    }
}
