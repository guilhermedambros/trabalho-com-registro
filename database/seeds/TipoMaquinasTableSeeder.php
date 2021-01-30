<?php

use App\TipoMaquina;
use Illuminate\Database\Seeder;

class TipoMaquinasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_maquinas = [
            ['descricao' => 'Pesada', 'valor_hora_subsidiado' => 50.00, 'tipo_bonificacao' => 'percentual'],
            ['descricao' => 'Leve', 'valor_hora_subsidiado' => 65.00, 'tipo_bonificacao' => 'valor'],
        ];

        TipoMaquina::insert($tipo_maquinas);
    }
}
