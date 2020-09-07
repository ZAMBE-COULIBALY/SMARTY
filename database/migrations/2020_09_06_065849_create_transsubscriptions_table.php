<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranssubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transsubscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('equipment');
            $table->string('model');
            $table->string('mark');
            $table->string('picture');
            $table->string('numberIMEI');
            $table->decimal('price', 10, 2);
            $table->date('date_subscription');
            $table->string('name');
            $table->string('first_name');
            $table->date('birth_date');
            $table->enum('gender', ['H', 'F','A']);
            $table->string('place_birth');
            $table->enum('marital_status', ['C', 'M','A']);
            $table->string('place_residence');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('mail');
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
        Schema::dropIfExists('transsubscriptions');
    }
}
