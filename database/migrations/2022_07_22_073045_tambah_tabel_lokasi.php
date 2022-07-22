<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('lokasi', function (Blueprint $table) {
            $table->bigIncrements('id_lokasi');
            $table->string('nama')->length(50)->unique();
            $table->string('alamat')->length(150);
            $table->string('hp')->length(15);
            $table->string('inisial_faktur')->length(3);
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
        Schema::dropIfExists('lokasi');
    }
};
