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
            ['descricao' => 'Pesada', 'valor_hora_subsidiado' => 65.00],
            ['descricao' => 'Leve', 'valor_hora_subsidiado' => 65.00],
        ];

        TipoMaquina::insert($tipo_maquinas);
    }
}
