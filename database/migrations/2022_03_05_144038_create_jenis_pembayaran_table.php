<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenisPembayaran', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->enum('status_pembayaran',['lunas','belum'])->nullable();
            $table->string('keterangan_pembayaran');
            $table->integer('debet_pembayaran')->nullable();
            $table->integer('kredit_pembayaran')->nullable();
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
        Schema::dropIfExists('jenisPembayaran');
    }
}
