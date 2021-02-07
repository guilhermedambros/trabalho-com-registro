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
    ];

    protected $fillable = [
        'id',
        'documento',
        'nome',
        'email',
        'telefone',
    ];

    
    
    public function tipo_pessoas()
    {
        return $this->belongsToMany(TipoPessoa::class, 'pessoa_tipo_pessoa', 'pessoa_id', 'tipo_pessoa_id');
    }

}
