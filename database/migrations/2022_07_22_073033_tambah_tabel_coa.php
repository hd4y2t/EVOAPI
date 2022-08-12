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
        Schema::create('coa', function (Blueprint $table) {
            $table->bigIncrements('id_coa');
            $table->string('kode_account')->length(10)->unique();
            $table->string('nama')->length(100);
            $table->string('posisi')->length(1);
            $table->string('letak')->length(6);
            $table->string('jns')->length(20);
            $table->foreignId('lokasi_id');
            $table->char('aktif')->length(1);
            $table->char('pakai_budget')->length(1);
            $table->integer('lama_budget_harian');
            $table->integer('lama_budget_bulanan');
            $table->float('budget_harian',15,0);
            $table->float('budget_bulanan',15,0);
            $table->char('flag_khusus')->length(1);
            $table->foreignId('kategori_id');
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
        Schema::dropIfExists('coa');
    }
};
