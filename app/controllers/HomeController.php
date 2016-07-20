<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index() {   

	$perfil_logueado=Auth::user()->get()->fk_perfiles_id;

	if ($perfil_logueado=='1'  || $perfil_logueado=='2'){
			$conn = DB::connection("pgsql");
           $my_id = Auth::user()->get()->id;
           $sql="select facultades.nombre_facultades,personas.nombre_user, 
				asignaturas.nombre_asignaturas, asignaciones.periodo, grupos.nombre_grupo,asignaturas.programa_id
				from facultades, asignaturas, asignaciones, personas, grupos, programas 
				where asignaciones.grupo_id = grupos.id
				and asignaciones.asignatura_id = asignaturas.id
				and asignaciones.docente_id = personas.id
				and asignaturas.programa_id = programas.id
				and asignaturas.programa_id = asignaturas.programa_id
				and facultades.id = programas.facultad_id
				and asignaciones.docente_id=?";

           $resultado= $conn->select($sql, array($my_id));          
           return View::make('HomeController.index', array("resultado" => $resultado));	
       }else{

       	 
       	 return Redirect::to('/vocero');
       
       } 	
           
        }
		


	public function login()
	{
		return View::make('HomeController.login');
	}

	public function reporte_semestral()
	{
		return View::make('HomeController.reporte_semestral');
	}

	

	public function vocero(){

     $perfil_logueado=Auth::user()->get()->fk_perfiles_id;

	if ($perfil_logueado=='1'  || $perfil_logueado=='2'){
		return Redirect::to('/index');

		}else{

		  $conn = DB::connection("pgsql");    
		  $my_id = Auth::user()->get()->id;      
           $sql="select distinct g.id, g.nombre_grupo,a.id, asi.nombre_asignaturas
				from grupos g, asignaciones a, personas p, asignaturas asi
				where g.id = a.grupo_id 
				and a.vocero_id = p.id
				and p.id = ?
				and asi.id = a.asignatura_id
				and g.id = a.grupo_id 
				and a.vocero_id = p.id
				and p.id = ? order by g.id	";

           $resultado= $conn->select($sql, array($my_id,$my_id)); 



		return View::make('HomeController.vocero', array("resultado" => $resultado));
	}			
		}

public function reporteDiario($programa_id)	{

		  $conn = DB::connection("pgsql");    
		  $my_id = Auth::user()->get()->id;      
           $sql="select facultades.nombre_facultades,docente.nombre_user, 
				asignaturas.nombre_asignaturas, asignaciones.periodo, grupos.nombre_grupo,temas.nombre_tema
				from facultades, asignaturas, asignaciones, personas vocero, grupos, programas, personas docente,temas 
				where asignaciones.grupo_id = grupos.id
				and asignaciones.asignatura_id = asignaturas.id
				and asignaciones.vocero_id = vocero.id
				and asignaciones.docente_id = docente.id
				and asignaturas.id = temas.asignatura_id
				and asignaturas.programa_id = programas.id
				and facultades.id = programas.facultad_id
				and vocero.fk_perfiles_id = 3
				and asignaciones.id =?";

           $resultado= $conn->select($sql, array($programa_id)); 

		return View::make('HomeController.RegistroDiario', array("resultado" => $resultado));	

}
	public function salir()	{
		Auth::user()->logout();
		return Redirect::to('/');
		
	}

	public function SesionOff()	{
		Auth::user()->logout();
			$messagee = '<div class="alert alert-danger">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>¡Error..Tu Sesión ha Expirado...Debes iniciar sesión para continuar.!</strong>
            </div>';

 		return Redirect::to('/')->with("messagee", $messagee);

		
		
	}



		public function ListarPDF(){
			//$users= User::all();
			//$html = View::make("FacultadIngieneria.listarPDF")->with('users', $users); 
			$html = View::make("HomeReportes.listarPDF"); 	 	       
		    return PDF::load($html, 'Letter', 'portrait')->show();
		 		
		}

}
