<?php
Route::get('/', function(){
	return View::make ('login');

});
Route::post('login','UserLogin@user');
Route::controller('principal','MenuPrincipalController');
Route::resource('users', 'UsersController');
Route::resource('tarifas', 'TarifasController');
Route::controller('tarifas/gettarifas', 'gettarifasController');

Route::get('logout',function(){
	Auth::logout();
	return Redirect::to('/');

	
});