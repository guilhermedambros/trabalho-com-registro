<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Traits\RecordSignature;
use App\User;

class Servico extends Model
{
    use SoftDeletes, HasFactory, RecordSignature;
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
        'endereco',
        'data_realizacao',
        'beneficiario_pessoa_id',
        'numero',
        'created_by',
        'modified_by',
        'deleted_by',
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
                    ->withPivot('valor', 'tempo')
                    ->withTimestamps();
    }

    public function criado_por()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

