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
        Schema::create('tb_taxas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo', 100);
            $table->double('vref', 8, 2);
            $table->double('percentual', 8, 2);
            $table->timestamps();
        });
    }

    /**clar
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_taxas');
    }
};
