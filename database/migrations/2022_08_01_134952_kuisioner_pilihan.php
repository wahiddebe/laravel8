<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KuisionerPilihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('kuisioner_pilihan');

        Schema::create('kuisioner_pilihan', function (Blueprint $table) {
            $table->bigInteger('kuisioner_id')->unsigned()->index();
            $table->foreign('kuisioner_id')->references('id')->on('kuisioners')->onDelete('cascade');
            $table->bigInteger('pilihan_id')->unsigned()->index();
            $table->foreign('pilihan_id')->references('id')->on('pilihan_kuis')->onDelete('cascade');
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
        //
    }
}
