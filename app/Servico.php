<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Carbon\Carbon;

use App\Http\Controllers\Traits\RecordSignature;
use App\User;

class Servico extends Model implements Auditable
{
    use HasFactory, RecordSignature;
    use \OwenIt\Auditing\Auditable;
    public $table = 'servicos';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'data_realizacao',
    ];

    protected $fillable = [
        'id',
        'endereco',
        'data_realizacao',
        'beneficiario_pessoa_id',
        'numero',
        'created_by',
        'modified_by',
    ];

    public function setDataRealizacaoAttribute($date)
    {
        $date = str_replace('/', '-', $date);
        $date = date("d-m-Y", strtotime($date));
        $this->attributes['data_realizacao'] = $date;
    }

    public function getDataRealizacaoAttribute()
    {
        $value = str_replace('-', '/', $this->attributes['data_realizacao']);
        return $value;
    }

    public function beneficiario()
    {
        return $this->belongsTo(Pessoa::class, 'beneficiario_pessoa_id');
    }

    public function maquinas()
    {
        return $this->belongsToMany(Maquina::class, 'servico_maquina', 'servico_id', 'maquina_id')
                    ->withPivot('valor_total', 'valor_subsidiado', 'valor_issqn', 'tempo')
                    ->withTimestamps();
    }

    public function criado_por()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

