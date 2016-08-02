<?php

class Sesion extends Eloquent	{
	
	protected $table = 'sesiones';


	public function tema()
	{
		return $this->belongsTo('Tema', 'tema_id');
	}


}