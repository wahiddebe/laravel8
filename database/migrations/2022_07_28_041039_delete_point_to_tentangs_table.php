<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeletePointToTentangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tentangs', function (Blueprint $table) {
            //
            $table->dropColumn('title_point');
            $table->dropColumn('desc_point');
            $table->longText('point')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tentang', function (Blueprint $table) {
            //
        });
    }
}
