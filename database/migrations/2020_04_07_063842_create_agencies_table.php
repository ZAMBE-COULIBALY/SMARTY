<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();

            $table->string('code');
            $table->unique(["code","partner_id"]);
            $table->string('label');
            $table->unique(["label","partner_id"]);
            $table->string('email')->nullable();
            $table->string('contact');
            $table->string('address');
            $table->string('state');
            $table->integer('partner_id');
            $table->string('slug');

            $table->integer('chief_id')->nullable();

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
        Schema::dropIfExists('agencies');
    }
}
