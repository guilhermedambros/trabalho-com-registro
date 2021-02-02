<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('documento')->nullable();
            $table->string('nome');
            $table->string('email')->nullable();
            $table->string('inscricao');
            $table->string('telefone', 20)->nullable();
            $table->string('cep', 8)->nullable();
            $table->string('endereco');
            $table->string('bairro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->date('data_associacao')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->decimal('issqn', 8, 2)->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('modified_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
