<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoPeriodo extends Model
{
    use HasFactory;
    public $table = 'saldo_periodos';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'pessoa_id',
        'saldo_pesadas',
        'saldo_agricolas',
        'created_by',
        'modified_by',
        'deleted_by',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }
    
}
