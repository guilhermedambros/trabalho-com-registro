<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;
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
        'tipo_pessoa_id',
        'created_by',
        'modified_by',
        'deleted_by',
    ];

    public function tipo_pessoa()
    {
        return $this->belongsTo(TipoPessoa::class, 'tipo_pessoa_id');
    }
}
