<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    public $table = 'pessoas';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'data_nascimento',
        'data_associacao',
    ];

    protected $fillable = [
        'id',
        'documento',
        'nome',
        'email',
        'inscricao',
        'telefone',
        'data_associacao',
        'cep',
        'endereco',
        'bairro',
        'numero',
        'complemento',
        'created_by',
        'modified_by',
        'deleted_by',
        'data_nascimento',
        'issqn',
    ];

    public function saldo_periodos()
    {
        return $this->hasMany(SaldoPeriodo::class);
    }
    public function maquinas()
    {
        return $this->hasMany(Maquina::class);
    }
    public function servicos()
    {
        return $this->hasMany(Servico::class);
    }

    public function setDataNascimentoAttribute($date) {
        if(!is_null($date)){
            $date = str_replace('/', '-', $date );
            $date = date("d-m-Y", strtotime($date));
            $this->attributes['data_nascimento'] = $date;
        }else{
            $this->attributes['data_nascimento'] = null;
        }
    }
    public function getDataNascimentoAttribute()
    {
        return (!is_null($this->attributes['data_nascimento'])) ? str_replace('-', '/', $this->attributes['data_nascimento']) : null;

    }

    public function setDataAssociacaoAttribute($date) {
       
        if(!is_null($date)){
            $date = str_replace('/', '-', $date );
            $date = date("d-m-Y", strtotime($date));
            $this->attributes['data_associacao'] = $date;
        }else{
            $this->attributes['data_associacao'] = null;
        }
        
    }
    public function getDataAssociacaoAttribute()
    {
        return (!is_null($this->attributes['data_associacao'])) ? str_replace('-', '/', $this->attributes['data_associacao']) : null;
    }

    public function getIssqnAttribute()
    {
        $parts = explode('.', $this->attributes['issqn']);
        return str_pad($parts[0], 2, "0", STR_PAD_LEFT).'.'.str_pad($parts[1] ?? 0, 2, "0", STR_PAD_RIGHT);
    }

    public function tipo_pessoas()
    {
        return $this->belongsToMany(TipoPessoa::class, 'pessoa_tipo_pessoa', 'pessoa_id', 'tipo_pessoa_id');
    }

    public function criado_por()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
