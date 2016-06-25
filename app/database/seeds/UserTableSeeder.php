<?php
Class UserTableSeeder extends Seeder{

	public function run(){

		DB::table('users')->delete();
		User::create(array(
			'nombre'=> 'Jorge',
			'apellido'=> 'Muñoz',			
			'email'=> 'Jorge_9128@hotmail.com',
			'username'=> 'villejo',
			'password'=> Hash::make('1234567'),
			'nivel'=> '1'
			));


		
	}
}