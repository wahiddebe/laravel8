<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumnToBeritasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beritas', function (Blueprint $table) {
            //
            $table->string('title')->nullable()->after('id');
            $table->string('slug')->nullable()->after('title');
            $table->string('gambar')->nullable()->after('slug');
            $table->longText('desc')->nullable()->after('gambar');
            $table->bigInteger('kategoris_id')->nullable()->after('desc');
            $table->string('penulis')->nullable()->after('kategoris_id');
            $table->string('status')->nullable()->after('penulis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beritas', function (Blueprint $table) {
            //
        });
    }
}
