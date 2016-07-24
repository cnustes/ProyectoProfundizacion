<?php

Route::get('/index','HomeController@index', function()
{
	return View::make('HomeController.index');
});


Route::get('/reporte_semestral','HomeController@reporte_semestral', function()
{
    return View::make('HomeController.reporte_semestral');
});

Route::resource('Pdf_Semestral','HomeController@ListarPDF');
Route::any('Pdf_Semestral', array('as'=>'Pdf_Semestral','uses'=>'HomeController@ListarPDF'))->before("auth_user");
Route::any('Repor_Excel_Semestral', array('as'=>'Repor_Excel_Semestral','uses'=>'HomeController@exportar_execel'))->before("auth_user");



Route::get('/login','HomeController@login', function()
{
	return View::make('HomeController.login');
});

Route::get('/salir','HomeController@salir', function(){});
Route::get('/SesionOff','HomeController@SesionOff', function(){});

Route::any('/', array('as'=>'login','uses'=>'HomeController@login'))->before("guest_user");

Route::any('/index', array('as'=>'index','uses'=>'HomeController@index'))->before("auth_user");
Route::any('/vocero', array('as'=>'vocero','uses'=>'HomeController@vocero'))->before("auth_user");
Route::any('/director', array('as'=>'vocero','uses'=>'HomeController@director'))->before("auth_user");


Route::any('/reporteDiario/{programa_id}', array('as'=>'reporteDiario','uses'=>'HomeController@reporteDiario'))->before("auth_user");


Route::any('/registroDiario', array('as'=>'registroDiario','uses'=>'HomeController@GuardarSesion'))->before("auth_user");


Route::get('/reporteDiario/{programa_id}','HomeController@reporteDiario', function()
{
    return View::make('HomeController.reporteDiario');
});

Route::any('/login', array('as'=>'login','uses'=>'HomeController@login'))->before("guest_user");
Route::any('/salir', array('as'=>'salir','uses'=>'HomeController@salir'));

Route::post('/login', array('before' => 'csrf', function(){
    
              
            $rules = array
                (
            "email" => "required|email|exists:personas",
            'password' => 'required',            
                );
    
             $messages = array
            (
        'email.required' => 'Ingrese el Email.',
        'email.exists' => 'El Email Ingresado No Se Encuentra Registrado',
        'email.email' => 'El Formato Email Esta Incorrecto.',
        'password.required' => 'Ingrese El Password.',
        'password.exists' => 'El Correo o Password estan incorrectos.',
    );
    
    $validator = Validator::make(Input::All(), $rules, $messages);
    
        if ($validator->passes()) {

            $user = array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),                    
                );
                
                $remember = Input::get("remember");
                $remember == 'On' ? $remember = true : $remember = false;
                
               
        $message = '<div class="alert alert-info">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Bienvenido </strong>
                            </div>';


                if (Auth::user()->attempt($user, $remember)){                    
                    return Redirect::route("index")->with("message", $message);    
                                
                  
                     
                  }else{
                $message = '<div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>¡Error... Email o Password Incorrectos..!</strong>
                            </div>';
    
                  return Redirect::back()->with("message", $message); 
                  }
                  }
                  return Redirect::back()->withInput()->withErrors($validator);                 
            }));



App::missing(function($exception){
	return Response::view('error.error404',array(),404);
});