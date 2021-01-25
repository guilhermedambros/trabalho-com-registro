<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\RecordSignature;

class Maquina extends Model implements Auditable
{
    use HasFactory, SoftDeletes, RecordSignature;
    use \OwenIt\Auditing\Auditable;
    public $table = 'maquinas';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'descricao',
        'proprietario_pessoa_id',
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

    public function proprietario()
    {
        return $this->belongsTo(Pessoa::class, 'proprietario_pessoa_id');
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'servico_maquina', 'maquina_id', 'servico_id')
                    ->withPivot('valor', 'tempo')
                    ->withTimestamps();
    }
}
