<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColoumnToHomeLingkupsTable extends Migration
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
            $table->dropColumn('gambar1');
            $table->dropColumn('gambar2');
            $table->string('gambar')->nullable();
            $table->string('judul')->nullable();
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
