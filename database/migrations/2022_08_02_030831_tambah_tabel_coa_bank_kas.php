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
        Schema::create('coa_bank_kas', function (Blueprint $table) {
            $table->bigIncrements('id_coa_bank_kas');
            $table->foreignId('coa_id');
            $table->string('jenis');
            $table->string('inisial');
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
        Schema::dropIfExists('coa_bank_kas');
    }
};
