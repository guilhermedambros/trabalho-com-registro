<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Pessoa extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    public $table = 'pessoas';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'data_nascimento',
    ];

    protected $fillable = [
        'id',
        'documento',
        'nome',
        'email',
        'rg',
        'telefone',
        'celular',
        'cep',
        'endereco',
        'bairro',
        'numero',
        'complemento',
        'cidade',
        'estado',
        'created_by',
        'modified_by',
        'deleted_by',
    ];

    public function tipos_pessoa()
    {
        return $this->belongsToMany(TipoPessoa::class, 'pessoa_tipo_pessoa', 'pessoa_id', 'tipo_pessoa_id');
    }
}
