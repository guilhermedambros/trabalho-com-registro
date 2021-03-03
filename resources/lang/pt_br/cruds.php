<?php

return [
    'userManagement' => [
        'title'          => 'Usuários',
        'title_singular' => 'Usuário',
    ],
    'permission'     => [
        'title'          => 'Permissões',
        'title_singular' => 'Permissão',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Criado em',
            'created_at_helper' => '',
            'updated_at'        => 'Última atualização',
            'updated_at_helper' => '',
            'deleted_at'        => 'Excluído em',
            'deleted_at_helper' => '',
        ],
    ],
    'role'           => [
        'title'          => 'Perfis',
        'title_singular' => 'Perfil',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'        => 'Criado em',
            'created_at_helper' => '',
            'updated_at'        => 'Última atualização',
            'updated_at_helper' => '',
            'deleted_at'        => 'Excluído em',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'           => [
        'title'          => 'Usuários',
        'title_singular' => 'Usuário',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'        => 'Criado em',
            'created_at_helper' => '',
            'updated_at'        => 'Última atualização',
            'updated_at_helper' => '',
            'deleted_at'        => 'Excluído em',
            'deleted_at_helper'        => '',
            'pessoa'        => 'Vínculo com Produtor',
        ],
    ],
    'pessoa'         => [
        'title'          => 'Parceiros',
        'title_singular' => 'Parceiro',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'project'           => 'Project',
            'project_helper'    => '',
            'files'             => 'Files',
            'files_helper'      => '',
            'created_at'        => 'Criado em',
            'created_at_helper' => '',
            'updated_at'        => 'Última atualização',
            'updated_at_helper' => '',
            'deleted_at'        => 'Excluído em',
            'deleted_at_helper' => '',
            'folder'            => 'Folder',
            'folder_helper'     => '',
            'id'                => 'Código',
            'documento'         => 'Documento',
            'nome'              => 'Nome',
            'email'             => 'E-mail',
            'telefone'          => 'Telefone',
            'tipo_pessoa'       => 'Tipo de pessoa'
        ],
    ],
    'demanda'         => [
        'title'          => 'Demandas',
        'title_singular' => 'Demanda',
        'fields'         => [
            'descricao'         => 'Descrição',
            'pessoa_id'         => 'Vínculo',
            'valor_hora'        => 'R$/hr definido',
            'data_inicio'       => 'Data de início',
            'data_entrega'      => 'Data da finalização',
            'data_prazo'        => 'Prazo',
            'created_at'        => 'Criado em',
            'updated_at'        => 'Última atualização',
            'deleted_at'        => 'Excluído em',
            'id'                => 'Código',
        ],
    ],
    'registro'         => [
        'title'          => 'Registros',
        'title_singular' => 'Registro',
        'fields'         => [
            'descricao'         => 'Descrição do atendimento',
            'user_id'           => 'Atendente',
            'demanda_id'        => 'Demanda de origem',
            'tempo'             => 'Tempo (h:m)',
            'data_registro'     => 'Data do atendimento',
            'created_at'        => 'Criado em',
            'updated_at'        => 'Última atualização',
            'deleted_at'        => 'Excluído em',
            'id'                => 'Código',
        ],
    ],
    'relatorios'         => [
        'title'          => 'Relatório de demandas',
        'title_singular' => 'Relatório de demandas',
        'fields'         => [
            'descricao'         => 'Descrição do atendimento',
            'user_id'           => 'Atendente',
            'demanda_id'        => 'Demanda de origem',
            'tempo'             => 'Tempo (h:m)',
            'data_registro'     => 'Data do atendimento',
            'created_at'        => 'Criado em',
            'updated_at'        => 'Última atualização',
            'deleted_at'        => 'Excluído em',
            'id'                => 'Código',
        ],
    ],
    'list'        => [
        'title'          => 'Listas',
        'title_singular' => 'Lista',
        'fields'         => [
            'id'                => 'ID',
        
        ],
    ],
];
