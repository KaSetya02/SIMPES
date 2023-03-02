<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPembayaranidJenisColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenisPembayaran', function (Blueprint $table) {
            $table->unsignedBigInteger('pembayaran_idpembayaran');
            $table->foreign('pembayaran_idpembayaran')->references('id')->on('pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenisPembayaran', function (Blueprint $table) {
            $table->dropForeign('pembayaran_idpembayaran');
            $table->dropColumn('pembayaran_idpembayaran');
        });
    }
}
