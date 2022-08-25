<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnToHomeLingkupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_lingkups', function (Blueprint $table) {
            //
            $table->string('gambar1')->nullable();
            $table->string('gambar2')->nullable();
            $table->text('point')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_lingkups', function (Blueprint $table) {
            //
        });
    }
}
