<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('numero')->unique();
            $table->string('endereco');
            $table->date('data_realizacao');
            $table->foreignId('beneficiario_pessoa_id')->constrained('pessoas');
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
        Schema::dropIfExists('servicos');
    }
}
