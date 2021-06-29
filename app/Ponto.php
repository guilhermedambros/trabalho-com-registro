<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Ponto extends Model  implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'data_ponto',
        'turno_1_entrada',
        'turno_1_saida',
        'turno_2_entrada',
        'turno_2_saida',
        'user_id',
    ];

    
    public function setDataPontoAttribute($date)
    {
        $date = str_replace('/', '-', $date);
        $date = date("Y-m-d", strtotime($date));
        $this->attributes['data_ponto'] = $date;
    }

    public function getDataPontoAttribute()
    {
        return (!is_null($this->attributes['data_ponto'])) ? 
                explode('-', $this->attributes['data_ponto'])[2].'/'.explode('-', $this->attributes['data_ponto'])[1].'/'.explode('-', $this->attributes['data_ponto'])[0] 
                : null;
      
    }

    public function funcionario()
    {
        return $this->belongsTo(User::class);
    }

}
