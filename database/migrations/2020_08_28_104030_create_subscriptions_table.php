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
            $table->string('code')->unique();
            $table->string('equipment');
            $table->string('model');
            $table->string('mark');
            $table->string('picture')->nullable();
            $table->string('numberIMEI')->unique();
            $table->decimal('price', 20, 2);
            $table->decimal('premium', 20, 2);
            $table->date('date_subscription');
            $table->date('subscription_enddate');
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->foreignId('agent_id')->references('id')->on('agents');
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
