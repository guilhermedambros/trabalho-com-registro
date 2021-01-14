<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TipoPessoa extends Model  implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    public $table = 'tipo_pessoas';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'descricao',
    ];

    public function pessoas()
    {
        return $this->belongsToMany(TipoPessoa::class, 'pessoa_tipo_pessoa', 'tipo_pessoa_id', 'pessoa_id');
    }
}
