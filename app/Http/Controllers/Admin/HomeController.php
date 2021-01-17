<?php

namespace App\Http\Controllers\Admin;
use App\SaldoPeriodo;
use Gate;

class HomeController
{
    public function index()
    {

        $saldos = (!Gate::denies('saldos_gerenciamento')) ? SaldoPeriodo::verifica_saldos_no_periodo_atual() : false;

        return view('home', compact('saldos'));
    }
}
