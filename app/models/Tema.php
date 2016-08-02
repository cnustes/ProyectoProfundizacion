<?php

class Tema extends Eloquent
{
	protected $table = 'temas';



	public function sesion()	    {
		return $this->belongsTo('Sesion', 'asignacion_id');
	}

	public function asignatura()
	{
		return $this->belongsTo('Asignatura', 'asignatura_id');
	}

	public function grupo()
	{
		return $this->belongsTo('Grupo', 'id');
	}

	public function asignacion()
	{
		return $this->belongsTo('Asignacion', 'asignatura_id');
	}

	public function facultad()
	{
		return $this->belongsTo('Facultad', 'id');
	}

	public function persona()
	{
		return $this->belongsTo('Persona', 'id');
	}


}