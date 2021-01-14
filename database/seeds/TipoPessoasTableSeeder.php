<?php

use App\TipoPessoa;
use Illuminate\Database\Seeder;


class TipoPessoasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_pessoas = [
            ['descricao' => 'Associado'],
            ['descricao' => 'Não Associado'],
            ['descricao' => 'Terceiro'],
            ['descricao' => 'Outros'],
            ['descricao' => 'Prestador de serviço'],
        ];

        TipoPessoa::insert($tipo_pessoas);
    }
}
