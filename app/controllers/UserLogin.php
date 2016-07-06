<?php

class UserLogin extends BaseController {

	public function user(){

		$userdata= array(
			'email'=> Input::get('email'),
			'password'=> Input::get('password')
			);
		
$message = '<div class="alert alert-danger">
                              <a class="alert-link"> <strong>¡Error.!</strong> Email o Password Incorrectos.</a>
                            </div>';

		


		if(Auth::attempt($userdata)){
			return Redirect::to('principal')->with("message", $message);
		}
		else
		{
		return Redirect::to('/')->with('login_errors',true);
			
	}
	}
}
