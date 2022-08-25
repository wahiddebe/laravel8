<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilKuisionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil__kuisioners', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->timestamp('tgllahir')->nullable();
            $table->string('usia')->nullable();
            $table->bigInteger('kategori_id')->unsigned();
            $table->bigInteger('hasil_kategori_id')->unsigned();
            $table->string('hasil')->nullable();
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
        Schema::dropIfExists('hasil__kuisioners');
    }
}
