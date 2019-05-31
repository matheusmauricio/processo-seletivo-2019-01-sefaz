<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelaLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('tabela_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rota');
            $table->dateTime('horario');
            $table->integer('cod_gtin');
            $table->integer('status_code');
            $table->integer('quantidade_produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabela_log');
    }
}
