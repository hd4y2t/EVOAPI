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
        Schema::create('jurnal_temp', function (Blueprint $table) {
                $table->bigIncrements('id_jurnal_temp');
                $table->string('kode_voucher')->length(20)->unique();
                $table->date('tanggal');
                $table->time('jam');
                $table->foreignId('user_id');
                $table->string('jenis')->length(2);
                $table->string('note')->length(80);
                $table->datetime('tanggal_input');
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
        Schema::dropIfExists('jurnal_temp');
    }
};