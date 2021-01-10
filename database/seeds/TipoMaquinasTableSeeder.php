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
            ['descricao' => 'Pessada'],
            ['descricao' => 'Leve'],
        ];

        TipoMaquina::insert($tipo_maquinas);
    }
}
