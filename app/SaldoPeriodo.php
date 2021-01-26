<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

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


    public static function verifica_saldos_no_periodo_atual(){
        $saldos_no_periodo = SaldoPeriodo::where('ano_exercicio', date('Y'))->get();
        $pessoas = Pessoa::all();
        $retorno['status'] = true;
        $retorno['msg'] = 'Verificamos que tudo está ok com os saldos dos produtores!';
        if(count($saldos_no_periodo) < 1 && count($pessoas) > 0){
            $retorno['status'] = false;
            $retorno['msg'] = 'Percebemos que os saldos para o período do ano em exercicio ('.date('Y').') ainda não foram preenchidos!';
        }
        if(count($saldos_no_periodo) < count($pessoas)){
            $retorno['status'] = false;
            $retorno['msg'] = 'Percebemos que alguns produtores cadastrados não estão com saldo preenchido para o ano de '.date('Y');
        }
        /*$associados = Pessoa::whereHas('tipo_pessoas', function (Builder $query) {
                            $query->where('tipo_pessoa_id', 1);
                        })->pluck('nome', 'id');*/
        return $retorno;
        
    }

    public static function ajusta_saldos_do_periodo_atual(){
        $retorno = true;
        $pessoas_sem_saldo_no_periodo = Pessoa::whereDoesntHave('saldo_periodos', function(Builder $query) {
                $query->where('ano_exercicio', date('Y'));
            })->get();
        foreach($pessoas_sem_saldo_no_periodo as $produtor){
            $saldo_periodo = new SaldoPeriodo();
            $saldo_periodo->ano_exercicio = date('Y');
            $saldo_periodo->saldo_pesadas = 10;
            $saldo_periodo->saldo_leves = (in_array(1, $produtor->tipo_pessoas->pluck('id')->toArray())) ? 40 : 0;
            $saldo_periodo->pessoa_id = $produtor->id;
            $saldo_periodo->created_by = \Auth::user()->id;
            if(!$saldo_periodo->save()){
                $retorno = false;
            }
        }
        return $retorno;
    }
    
}
