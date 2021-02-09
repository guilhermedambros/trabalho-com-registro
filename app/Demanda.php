<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demanda extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    public $table = 'demandas';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'descricao',
        'pessoa_id',
        'valor_hora',
        'data_inicio',
        'data_entrega',
        'data_prazo',
    ];

    public function setDataInicioAttribute($date)
    {
        $date = str_replace('/', '-', $date);
        $date = date("d-m-Y", strtotime($date));
        $this->attributes['data_inicio'] = $date;
    }

    public function getDataInicioAttribute()
    {
        $value = str_replace('-', '/', $this->attributes['data_inicio']);
        return $value;
    }

    public function setDataEntregaAttribute($date) {
        if(!is_null($date)){
            $date = str_replace('/', '-', $date );
            $date = date("Y-d-m", strtotime($date));
            $this->attributes['data_entrega'] = $date;
        }else{
            $this->attributes['data_entrega'] = null;
        }
    }
    public function getDataEntregaAttribute()
    {   
        $value = str_replace('-', '/', $this->attributes['data_entrega']);
        return (!is_null($this->attributes['data_entrega'])) ? 
                explode('-', $this->attributes['data_entrega'])[2].'/'.explode('-', $this->attributes['data_entrega'])[1].'/'.explode('-', $this->attributes['data_entrega'])[0] 
                : null;

    }

    public function setDataPrazoAttribute($date) {
        if(!is_null($date)){
            $date = str_replace('/', '-', $date );
            $date = date("d-m-Y", strtotime($date));
            $this->attributes['data_prazo'] = $date;
        }else{
            $this->attributes['data_prazo'] = null;
        }
    }
    public function getDataPrazoAttribute()
    {
        return (!is_null($this->attributes['data_prazo'])) ? str_replace('-', '/', $this->attributes['data_prazo']) : null;

    }
    
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function registros()
    {
        return $this->hasMany(Registro::class);
    }
}
