<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldoPeriodos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldo_periodos', function (Blueprint $table) {
            $table->id();
            $table->integer('ano_exercicio');
            $table->decimal('saldo_pesadas', 8, 2);
            $table->decimal('saldo_agricolas', 8, 2);
            $table->foreignId('pessoa_id')->constrained('pessoas');
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
        Schema::dropIfExists('saldo_periodos');
    }
}
