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
        Schema::create('jurnal_temp_edit', function (Blueprint $table) {
                $table->integer('id_jurnal');
                $table->string('kode_voucher')->length(20)->unique();
                $table->date('tanggal');
                $table->string('jenis')->length(2);
                $table->string('note')->length(80);
                $table->foreignId('id_coa_atas')->nullable();
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
        Schema::dropIfExists('jurnal_temp_edit');
    }
};