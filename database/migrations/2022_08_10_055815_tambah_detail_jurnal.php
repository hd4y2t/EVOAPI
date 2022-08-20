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
        Schema::create('detail_jurnal', function (Blueprint $table) {
                $table->bigIncrements('id_detail_jurnal');
                $table->foreignId('jurnal_id');
                $table->foreignId('coa_id');
                $table->string('keterangan')->length(80);
                $table->decimal('debit', 15, 0);
                $table->decimal('kredit', 15, 0);
                $table->string('flag_dari_atas')->length(1);
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
          Schema::dropIfExists('detail_jurnal');
    }
};
