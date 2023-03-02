<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNisWalisantriColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('walisantri', function (Blueprint $table) {
            $table->unsignedBigInteger('santri_id');
            $table->foreign('santri_id')->references('id')->on('santri');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('walisantri', function (Blueprint $table) {
            $table->dropForeign('santri_id');
            $table->dropColumn('santri_id');
        });
    }
}
