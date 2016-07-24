<?php

	class Asignacion extends Eloquent
	{
		protected $table = 'asignaciones';




	       public function asignatura()
	    {
	        return $this->belongsTo('Asignatura', 'asignatura_id');
	    }


	

	    public function grupo()
	    {
	    	return $this->belongsTo('Grupo', 'grupo_id');
	    }

	    public function perfil()
	    {
	    	return $this->belongsTo('Perfil', 'id');
	    }

	    public function persona()
	    {
	    	return $this->belongsTo('Persona', 'docente_id');
	    }

	    public function tema()
	    {
	    	return $this->belongsTo('Tema', 'asignatura_id');
	    }    
	    
	    public function facultad()	    {
	    	return $this->belongsTo('Facultad', 'asignatura_id');
	    }

	}