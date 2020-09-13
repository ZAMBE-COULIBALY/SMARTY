<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('first_name');
            $table->date('birth_date');
            $table->enum('gender', ['Monsieur', 'Madame','Mademoiselle']);
            $table->string('place_birth');
            $table->enum('marital_status', ['Celibataire', 'Marie(e)','Divorce(e)','Veuf(ve)']);
            $table->string('place_residence');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('mail');
            $table->string('mailing_address')->nullable();
            $table->string('folder')->nullable();

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
        Schema::dropIfExists('customers');
    }
}
