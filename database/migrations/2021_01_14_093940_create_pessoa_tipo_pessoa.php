<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoaTipoPessoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_tipo_pessoa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->constrained('pessoas');
            $table->foreignId('tipo_pessoa_id')->constrained('tipo_pessoas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoa_tipo_pessoa');
    }
}
