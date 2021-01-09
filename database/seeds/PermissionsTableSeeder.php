<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'gerenciamento_usuario',
            ],
            [
                'id'    => 2,
                'title' => 'permissao_criar',
            ],
            [
                'id'    => 3,
                'title' => 'permissao_editar',
            ],
            [
                'id'    => 4,
                'title' => 'permissao_ver',
            ],
            [
                'id'    => 5,
                'title' => 'permissao_excluir',
            ],
            [
                'id'    => 6,
                'title' => 'permissao_acessar',
            ],
            [
                'id'    => 7,
                'title' => 'perfil_criar',
            ],
            [
                'id'    => 8,
                'title' => 'perfil_editar',
            ],
            [
                'id'    => 9,
                'title' => 'perfil_ver',
            ],
            [
                'id'    => 10,
                'title' => 'perfil_excluir',
            ],
            [
                'id'    => 11,
                'title' => 'perfil_acessar',
            ],
            [
                'id'    => 12,
                'title' => 'usuario_criar',
            ],
            [
                'id'    => 13,
                'title' => 'usuario_editar',
            ],
            [
                'id'    => 14,
                'title' => 'usuario_ver',
            ],
            [
                'id'    => 15,
                'title' => 'usuario_excluir',
            ],
            [
                'id'    => 16,
                'title' => 'usuario_acessar',
            ],
            [
                'id'    => 17,
                'title' => 'maquina_criar',
            ],
            [
                'id'    => 18,
                'title' => 'maquina_editar',
            ],
            [
                'id'    => 19,
                'title' => 'maquina_ver',
            ],
            [
                'id'    => 20,
                'title' => 'maquina_excluir',
            ],
            [
                'id'    => 21,
                'title' => 'maquina_acessar',
            ],
            [
                'id'    => 22,
                'title' => 'servico_criar',
            ],
            [
                'id'    => 23,
                'title' => 'servico_editar',
            ],
            [
                'id'    => 24,
                'title' => 'servico_ver',
            ],
            [
                'id'    => 25,
                'title' => 'servico_excluir',
            ],
            [
                'id'    => 26,
                'title' => 'servico_acessar',
            ],
            [
                'id'    => 27,
                'title' => 'pessoa_criar',
            ],
            [
                'id'    => 28,
                'title' => 'pessoa_editar',
            ],
            [
                'id'    => 29,
                'title' => 'pessoa_ver',
            ],
            [
                'id'    => 30,
                'title' => 'pessoa_excluir',
            ],
            [
                'id'    => 31,
                'title' => 'pessoa_acessar',
            ],
            [
                'id'    => 32,
                'title' => 'senha_editar',
            ],
            [
                'id'    => 33,
                'title' => 'relatorios_acessar',
            ],
        ];

        Permission::insert($permissions);
    }
}
