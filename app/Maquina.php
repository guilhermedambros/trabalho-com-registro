<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    use HasFactory;
    public $table = 'maquinas';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'descricao',
        'valor_hora',
        'tipo_maquina_id',
        'created_by',
        'modified_by',
        'deleted_by',
    ];

    public function tipo_maquina()
    {
        return $this->belongsTo(TipoMaquina::class, 'tipo_maquina_id');
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'servico_maquina', 'maquina_id', 'servico_id')
                    ->withPivot('valor')
                    ->withTimestamps();
    }
}
