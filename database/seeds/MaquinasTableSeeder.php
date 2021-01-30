<?php

namespace Database\Seeders;
use App\Maquina;

use Illuminate\Database\Seeder;

class MaquinasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maquinas = [
            ['descricao' => 'Trator', 'proprietario_pessoa_id' => 3, 'valor_hora' => 80.00, 'tipo_maquina_id' => 1],
            ['descricao' => 'Patrola', 'proprietario_pessoa_id' => 3, 'valor_hora' => 180.00, 'tipo_maquina_id' => 1],
            ['descricao' => 'Caminhão Caçamba', 'proprietario_pessoa_id' => 3, 'valor_hora' => 110.00, 'tipo_maquina_id' => 1],
            ['descricao' => 'Leve', 'proprietario_pessoa_id' => 3, 'valor_hora' => 200.00, 'tipo_maquina_id' => 2],
        ];

        Maquina::insert($maquinas);
    }
}
