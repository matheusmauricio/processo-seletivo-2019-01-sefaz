<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBancoSefaz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banco_sefaz', function (Blueprint $table) {
            $table->integer('COD_GTIN');
            $table->string('DAT_EMISSAO');
            $table->string('COD_TIPO_PAGAMENTO');
            $table->integer('COD_PRODUTO');
            $table->integer('COD_NCM');
            $table->string('COD_UNIDADE');
            $table->string('DSC_PRODUTO');
            $table->double('VLR_UNITARIO');
            $table->integer('ID_ESTABELECIMENTO');
            $table->string('NME_ESTABELECIMENTO');
            $table->string('NME_LOGRADOURO');
            $table->integer('COD_NUMERO_LOGRADOURO');
            $table->string('NME_COMPLEMENTO');
            $table->string('NME_BAIRRO');
            $table->integer('COD_MUNICIPIO_IBGE');
            $table->string('NME_MUNICIPIO');
            $table->string('NME_SIGLA_UF');
            $table->integer('COD_CEP');
            $table->double('NUM_LATITUDE');
            $table->double('NUM_LONGITUDE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banco_sefaz');
    }
}
