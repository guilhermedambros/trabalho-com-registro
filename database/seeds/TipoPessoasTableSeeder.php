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
            ['descricao' => 'Contratante'],
            ['descricao' => 'Contratada'],
        ];

        TipoPessoa::insert($tipo_pessoas);
    }
}
