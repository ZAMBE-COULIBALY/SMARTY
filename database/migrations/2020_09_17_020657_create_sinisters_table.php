<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinisters', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->string('contract');
            $table->string('vouchers');
            $table->string('type1')->nullable();
            $table->string('type2')->nullable();
            $table->integer('state');
            $table->string('folder');
            $table->foreign ('folder')->references('code')->on('subscriptions');
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
        Schema::dropIfExists('sinisters');
    }
}
