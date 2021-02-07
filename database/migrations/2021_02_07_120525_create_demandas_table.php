<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandas', function (Blueprint $table) {
            $table->id();
            $table->text('descricao');
            $table->foreignId('pessoa_id')->nullable()->constrained('pessoas');
            $table->decimal('valor_hora', 8, 2)->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_entrega')->nullable();
            $table->date('data_prazo')->nullable();
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
        Schema::dropIfExists('demandas');
    }
}
