<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class AddCodeToSinisters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sinisters', function (Blueprint $table) {
            //
            $table->string('code')->default(Str::random(14));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sinisters', function (Blueprint $table) {
            //
            $table->dropColumn("code");

        });
    }
}
