<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoMaquina extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    public $table = 'tipo_maquinas';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'descricao',
        'valor_hora_subsidiado',
        'tipo_bonificacao',
    ];


    public function getValorHoraSubsidiadoAttribute()
    {
        return  number_format($this->attributes['valor_hora_subsidiado'], 2, ',', '');
    }

   
}
