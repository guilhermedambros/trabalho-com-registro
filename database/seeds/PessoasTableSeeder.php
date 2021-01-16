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
            ['nome' => 'Pessoa Associada', 'email' => 'pa@mail.com', 'created_by' => 1, 'documento' => '12345678910', 'telefone' => '54996048965'],
            ['nome' => 'Pessoa Não Associada', 'email' => 'pna@mail.com', 'created_by' => 1, 'documento' => '12345678911', 'telefone' => '54996048965'],
            ['nome' => 'Pessoa Prestadora', 'email' => 'pp@mail.com', 'created_by' => 1, 'documento' => '12345678912', 'telefone' => '54996048965'],
            ['nome' => 'Pessoa Associada e Prestadora', 'email' => 'pap@mail.com', 'created_by' => 1, 'documento' => '12345678913', 'telefone' => '54996048965'],
            ['nome' => 'Pessoa Outros', 'email' => 'po@mail.com', 'created_by' => 1, 'documento' => '12345678914', 'telefone' => '54996048965'],
            ['nome' => 'Pessoa Terceiro', 'email' => 'pt@mail.com', 'created_by' => 1, 'documento' => '12345678915', 'telefone' => '54996048965'],

        ];

        Pessoa::insert($pessoas);

        $pessoas = Pessoa::all();
        foreach($pessoas as $pessoa){
            if($pessoa->email == 'pa@mail.com'){
                $pessoa->tipo_pessoas()->sync([1]);
            }
            if($pessoa->email == 'pna@mail.com'){
                $pessoa->tipo_pessoas()->sync([2]);
            }
            if($pessoa->email == 'pp@mail.com'){
                $pessoa->tipo_pessoas()->sync([5]);
            }
            if($pessoa->email == 'pap@mail.com'){
                $pessoa->tipo_pessoas()->sync([1,5]);
            }
            if($pessoa->email == 'po@mail.com'){
                $pessoa->tipo_pessoas()->sync([4]);
            }
            if($pessoa->email == 'pt@mail.com'){
                $pessoa->tipo_pessoas()->sync([3]);
            }

        }
    }
}
