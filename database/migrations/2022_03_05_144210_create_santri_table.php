<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('nama_santri');
            $table->date('tanggal_lahir_santri');
            $table->string('alamat_santri');
            $table->string('foto_santri')->nullable();
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('kamar_santri');
            $table->string('asrama_santri');
            $table->enum('status_aktif',['yes','no'])->nullable();
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
        Schema::dropIfExists('santri');
    }
}
