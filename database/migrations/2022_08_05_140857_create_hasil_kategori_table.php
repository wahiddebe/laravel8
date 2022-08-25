<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_kategori', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kategori_id')->unsigned();
            $table->string('min_jawaban');
            $table->string('max_jawaban');
            $table->longText('jawaban');
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
        Schema::dropIfExists('hasil_kategori');
    }
}
