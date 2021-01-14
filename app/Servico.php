<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\RecordSignature;

class Servico extends Model
{
    use HasFactory, RecordSignature;
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
        'beneficiario_pessoa_id',
        'numero',
        'created_by',
        'modified_by',
        'deleted_by',
    ];

    public function fromDateTime($value)
    {
        return Carbon::parse(parent::fromDateTime($value))->format('Y-m-d H:i:s');
    }

    public function setDataRealizacaoAttribute($date)
    {
        if (isset($date)) {
            $date = str_replace('/', '-', $date);
            $date = date("Y-m-d H:i:s", strtotime($date));
            $this->attributes['data_realizacao'] = $date;
        } else {
            $this->attributes['data_realizacao'] = null;
        }
    }

    public function getDataRealizacaoAttribute()
    {
        $this->attributes['data_realizacao'] = date('d/m/Y', strtotime($this->attributes['data_realizacao']));
        return $this->attributes['data_realizacao'];
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
}

