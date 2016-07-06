<?php
Route::get('/', function(){
	return View::make ('login');

});
Route::post('login','UserLogin@user');
Route::controller('principal','MenuPrincipalController');
Route::resource('users', 'UsersController');
Route::resource('tarifas', 'TarifasController');
Route::controller('tarifas/gettarifas', 'gettarifasController');
Route::resource('notificaciones','NotificacionesController@index');
Route::resource('plancurso','PlanDeCursoController@index');
Route::resource('reportes','ReportesController@index');


Route::get('logout',function(){
	Auth::logout();
	return Redirect::to('/');

	
});

/* Redireccion a página de error 404 */
App::missing(function($exception)
{
    return Response::view('error.error404', array(), 404);
});