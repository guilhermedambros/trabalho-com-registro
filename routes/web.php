<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});

 // Pessoas
 Route::delete('pessoas/destroy', 'PessoasController@massDestroy')->name('pessoas.massDestroy');
 Route::resource('pessoas', 'PessoasController');

 // Tipo Maquina
 Route::delete('tipo_maquinas/destroy', 'TipoMaquinasController@massDestroy')->name('tipo_maquinas.massDestroy');
 Route::resource('tipo_maquinas', 'TipoMaquinasController');

 // Saldo Periodo
 Route::delete('saldo_periodos/destroy', 'SaldoPeriodosController@massDestroy')->name('saldo_periodos.massDestroy');
 Route::get('saldo_periodos/ajusta', 'SaldoPeriodosController@ajusta_saldos_do_periodo_atual')->name('saldo_periodos.ajusta_saldos_do_periodo_atual');
 Route::resource('saldo_periodos', 'SaldoPeriodosController');

// Maquinas
Route::delete('maquinas/destroy', 'MaquinasController@massDestroy')->name('maquinas.massDestroy');
Route::resource('maquinas', 'MaquinasController');
Route::post('maquinas/get_valor_hora', 'MaquinasController@get_valor_hora')->name('maquinas.get_valor_hora');

// Servicos
Route::delete('servicos/destroy', 'ServicosController@massDestroy')->name('servicos.massDestroy');
Route::resource('servicos', 'ServicosController');