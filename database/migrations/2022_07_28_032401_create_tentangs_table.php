<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTentangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tentangs', function (Blueprint $table) {
            $table->id();
            $table->string('title_hero')->nullable();
            $table->text('desc_hero')->nullable();
            $table->text('gambar_hero')->nullable();
            $table->string('title_visi')->nullable();
            $table->text('desc_visi')->nullable();
            $table->string('title_misi')->nullable();
            $table->text('desc_misi')->nullable();
            $table->string('title_layanan')->nullable();
            $table->text('gambar_layanan')->nullable();
            $table->string('title_point')->nullable();
            $table->text('desc_point')->nullable();

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
        Schema::dropIfExists('tentangs');
    }
}
