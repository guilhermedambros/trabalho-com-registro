<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model  implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    public $table = 'registros';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'descricao',
        'data_registro',
        'tempo',
        'demanda_id',
        'user_id',
    ];

    public function setDataRegistroAttribute($date)
    {
        $date = str_replace('/', '-', $date);
        $date = date("Y-d-m", strtotime($date));
        $this->attributes['data_registro'] = $date;
    }

    public function getDataRegistroAttribute()
    {
        return (!is_null($this->attributes['data_registro'])) ? 
                explode('-', $this->attributes['data_registro'])[2].'/'.explode('-', $this->attributes['data_registro'])[1].'/'.explode('-', $this->attributes['data_registro'])[0] 
                : null;
      
    }
    
    public function demanda()
    {
        return $this->belongsTo(Demanda::class);
    }

    public function atendente()
    {
        return $this->belongsTo(User::class);
    }
}
