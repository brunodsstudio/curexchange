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
        Schema::create('tb_cotacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MoedaOrigem', 3);
            $table->string('MoedaDestino', 3);
            $table->double('vConvercao', 8, 2);
            $table->string('formaPagamento', 10);
            $table->double('vMoedaDestino', 8, 2);
            $table->double('vFinalCompradoMoedaDestino', 8, 2);
            $table->double('vTaxaPagamentoOrigem', 8, 2);
            $table->double('vTaxaConversaoOrigem', 8, 2);
            $table->double('vFinalUtilizadoOrigem', 8, 2);
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
        Schema::dropIfExists('tb_cotacoes');
    }
};
