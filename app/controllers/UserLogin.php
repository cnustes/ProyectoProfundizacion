<?php

class UserLogin extends BaseController {

	public function user(){

		$userdata= array(
			'username'=> Input::get('username'),
			'password'=> Input::get('password')
			);
		if(Auth::attempt($userdata)){
			return Redirect::to('principal');
		}
		else
		{
		return Redirect::to('/')->with('login_errors',true);
			
	}
	}
}
