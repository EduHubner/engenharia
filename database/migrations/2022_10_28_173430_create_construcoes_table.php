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
        Schema::create('construcoes', function (Blueprint $table) {
            $table->id();   
            $table->string('situacao', 100);
            $table->string('preco', 50);
            $table->boolean('pago');
            $table->boolean('aprovacaoBombeiros');
            $table->boolean('alvaraDeConstrucao');
            $table->string('areaTerreno', 100);
            $table->dateTime('dataInicio');
            $table->dateTime('dataFim');
            $table->text('detalhes');
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
        Schema::dropIfExists('construcoes');
    }
};