<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();
            $table->string('label')->unique();
            $table->string('email')->nullable();
            $table->string('contact');
            $table->string('state');
            $table->string('slug');

            $table->unsignedBigInteger('admin_id')->default(1);
            $table->foreign('admin_id')->references('id')->on('users');

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
        Schema::dropIfExists('partners');
    }
}
