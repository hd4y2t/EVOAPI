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
        Schema::create('jurnal', function (Blueprint $table) {
                $table->bigIncrements('id_jurnal');
                $table->string('kode_voucher')->length(20)->unique();
                $table->date('tanggal');
                $table->time('jam');
                $table->foreignId('user_id');
                $table->string('jenis')->length(2);
                $table->string('note')->length(80);
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
        Schema::dropIfExists('jurnal');
            //
        
    }
};