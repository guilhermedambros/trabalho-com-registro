<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;
    public $table = 'servicos';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'data_realizacao',
    ];

    protected $fillable = [
        'id',
        'descricao',
        'pessoa_id',
        'numero',
        'created_by',
        'modified_by',
        'deleted_by',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function maquinas()
    {
        return $this->belongsToMany(Maquina::class, 'servico_maquina', 'servico_id', 'maquina_id')
                    ->withPivot('valor', 'tempo')
                    ->withTimestamps();
    }
}

