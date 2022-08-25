<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilKuisionerPilihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil__kuisioner__pilihans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hasil_kuisioner_id')->unsigned();
            $table->string('nilai')->nullable();
            $table->string('pertanyaan')->nullable();
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
        Schema::dropIfExists('hasil__kuisioner__pilihans');
    }
}
