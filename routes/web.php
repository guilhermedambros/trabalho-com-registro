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

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

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

 // Demandas
 Route::delete('demandas/destroy', 'DemandasController@massDestroy')->name('demandas.massDestroy');
 Route::resource('demandas', 'DemandasController');


 //Relatorios
 Route::get('relatorios/demandas', 'RelatoriosController@index')->name('relatorios.demandas.index');
 Route::post('relatorios/demandas/gerar', 'RelatoriosController@gerar')->name('relatorios.demandas.gerar');


 Route::post('registros/store/{demanda}', 'RegistrosController@store')->name('registros.store');

  // Demandas
  Route::match(['get', 'post'], 'ponto', 'PontoController@index')->name('ponto.index');
  Route::post('ponto/store', 'PontoController@store')->name('ponto.store');

 