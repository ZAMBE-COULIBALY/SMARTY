<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('equipment');
            $table->string('model');
            $table->string('mark');
            $table->string('picture');
            $table->string('numberIMEI');
            $table->decimal('price', 10, 2);
            $table->date('date_subscription');
            $table->foreignId('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('subscriptions');
    }
}
