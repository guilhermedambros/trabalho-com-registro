<?php

use App\Pessoa;
use Illuminate\Database\Seeder;


class PessoasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pessoas = [
            ['nome' => 'Infus Soluções em Tecnologias'],
            ['nome' => '4SOFTWARE'],
            ['nome' => 'Particular'],
            
        ];

        Pessoa::insert($pessoas);

        
    }
}
