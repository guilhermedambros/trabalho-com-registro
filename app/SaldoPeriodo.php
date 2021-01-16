<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaldoPeriodo extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    public $table = 'saldo_periodos';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'pessoa_id',
        'ano_exercicio',
        'saldo_pesadas',
        'saldo_leves',
        'created_by',
        'modified_by',
        'deleted_by',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function criado_por()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}
