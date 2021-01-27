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
    ];

    protected $fillable = [
        'id',
        'documento',
        'nome',
        'email',
        'inscricao',
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
        'data_nascimento',
    ];

    public function saldo_periodos()
    {
        return $this->hasMany(SaldoPeriodo::class);
    }
    public function servicos()
    {
        return $this->hasMany(Servico::class);
    }

    public function setDataNascimentoAttribute($date) {
        $date = str_replace('/', '-', $date );
        $date = date("d-m-Y", strtotime($date));
        $this->attributes['data_nascimento'] = $date;
    }
    public function getDataNascimentoAttribute()
    {
        $value = str_replace('-', '/', $this->attributes['data_nascimento']);
        return $value;
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
