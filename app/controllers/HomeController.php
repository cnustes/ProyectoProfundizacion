<?php

use Carbon\Carbon;

class HomeController extends BaseController {


	public function __construct(){
		Carbon::setLocale('es');

	}

	public function index() {   

		$perfil_logueado=Auth::user()->get()->perfil_id;

		if ($perfil_logueado=='1'){

			return Redirect::to('/director');

		}else if ($perfil_logueado=='2'){    

			$my_id = Auth::user()->get()->id;
			$resultado = Asignacion::where('docente_id', $my_id)->get();

			return View::make('HomeController.index')
			->with('resultado', $resultado);			

		}else{
			return Redirect::to('/vocero');
		}	

	}	
	

	public function vocero(){

		$perfil_logueado=Auth::user()->get()->perfil_id;

		if ($perfil_logueado=='1'  || $perfil_logueado=='2'){
			return Redirect::to('/index');

		}else{	

			$my_id = Auth::user()->get()->id;    
			$resultado = Asignacion::where('vocero_id', $my_id)->get();

			return View::make('HomeController.vocero')
			->with('resultado', $resultado);


		}
	} 


	public function director(){
		
		return View::make('HomeController.director');

	} 



	public function exportar_execel(){
		Excel::create('Reporte de Asignacion', function($excel) {			

			$excel->sheet('Asignacion', function($sheet) {

				$asignacion = Asignacion::all();

				$sheet->fromArray($asignacion);
				$sheet->setOrientation('landscape');

			});

		})->export('xls');
	}


	public function login()
	{
		return View::make('HomeController.login');
	}

	public function reporte_semestral()
	{	
		$docentes = Persona::where('perfil_id', 2)->get();
		$nombre_docente=[];
		$nombre_docente[0] = "---";
		foreach ($docentes as $docente) {
			$nombre_docente[$docente->id] = $docente->nombre_user .' '.$docente->apellido_user;
		}
		return View::make('HomeController.reporte_semestral')
		->with('docentes',$nombre_docente)
		->with('materias',["---"]);
	}

	public function listarMaterias()	{
		$docente_id=Input::get('id');
		$asignaciones = Asignacion::where('docente_id', $docente_id)->with('asignatura')->get();
		return $asignaciones;		
	}

	public function listarSemana()	{
		$Tema_id=Input::get('id');
		$temas = Tema::where('id', $Tema_id)->get();
		return $temas;

		// $nombre_semanas=[];
		// $nombre_semanas[0] = "---";
		// foreach ($temas as $tema) {
		// 	$nombre_semanas[$tema->id] = $tema->semana;
		// }
		// return $nombre_semanas;
	}

	public function reporteDiario($asignacion_id)	{
		//$asignacion_id = Input::get('asignacion_id');
		$temas = Tema::where('asignatura_id', $asignacion_id)->get();
		$asignacion = Asignacion::where('asignatura_id', $asignacion_id)->first();
		$sesiones  = Sesion::where('asignacion_id', $asignacion_id)->get();	



		$nombre_temas=[];
		$nombre_temas[0] = "---";
		foreach ($temas as $tema) {
			$nombre_temas[$tema->id] = $tema->nombre_tema;
		}




		return View::make('HomeController.RegistroDiario')
		->with("temas", $temas)
		->with("asignacion", $asignacion)
		->with("sesiones", $sesiones)
		->with('nombre_temas',$nombre_temas)
		->with('semanas',["---"]);
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
	$html = View::make("HomeReportes.listarPDF"); 	 	       
	return PDF::load($html, 'Letter', 'A4', 'landscape')->show();

}


public function GuardarSesion()	{

	$asignacion_id = Input::get('asignacion_id');	
	$fecha_sesion  = Input::get('fecha_sesion');	
	$asignacion_id2=0;
	$fecha_sesion2=0;
	$numero=0;
	

	$sesiones = DB::table('sesiones')->where('asignacion_id', '=', $asignacion_id)->where('fecha_sesion', '=', $fecha_sesion)->get();
	

	foreach($sesiones as $key => $user){


		$asignacion_id2=$user->asignacion_id;
		echo "$asignacion_id2";
		echo "$fecha_sesion2";
		
	}
	if($asignacion_id2==null && $fecha_sesion2==null ){
		

		$rules = array
		(
			'tema_id'				=> 'required|numeric',	
			'asignacion_id' 		=> 'required',
			'hora'					=> 'required|numeric',				
			'semana'				=> 'numeric',	
			'tema_adicional' 		=> 'regex:/^[a-záéóóúàèìòùäëïöüñ\s]+$/i|min:5|max:50',
			'firma_docente' 		=> 'required',			
			'estado'				=> 'min:1|max:15',
			'observacion_vocero' 	=> 'min:4|max:50',
			'observacion_docente'	=> 'min:4|max:50'		
			);

		$message = array
		(
			'tema_id.numeric' => '* Porfavor Seleccione un tema.',
			'tema_id.required' => '* Porfavor Seleccione un tema.',
			'hora.required' => '* Porfavor Seleccione la cantidad de horas.',		
			'semana.required' => '* El campo semana es requerido.',
			'semana.max' => '* El campo semana no puede ser mayor a 3 caracteres.',
			'semana.min' => '* El campo semana no puede ser menor a 1 caracteres.',	
			'semana.numeric' => '* El campo semana es un campo numerico',	
			'semana.numeric' => '* El campo semana debe ser numerico.',
			'tema_adicional.regex' => '* Sólo se aceptan letras.',
			'tema_adicional.min' => '* Mínimo 5 caracteres',
			'tema_adicional.max' => '* Máximo 50 caracteres',
			'firma_docente.required' => '* Debes Firmar la sesion antes de guardar la sesion.',
			'observacion_vocero.regex' => '* Las Obervaciones Sólo se aceptan letras',
			'observacion_vocero.min' => '* Las Obervaciones Mínimo son minimo 5 caracteres',
			'observacion_vocero.max' => '* Las Obervaciones Mínimo son Máximo 50 caracteres',
			'observacion_docente.regex' => '* Las ObervacionesMínimo Sólo se aceptan letras.',
			'observacion_docente.min' => '* Mínimo 4 caracteres',
			'observacion_docente.max' => '* Máximo 50 caracteres'
			);

		$validator = Validator::make(Input::All(), $rules, $message);

		if ($validator->passes()) {
			$sesion = new Sesion;
			$sesion->asignacion_id 		 = Input::get('asignacion_id');		
			$sesion->hora				 = Input::get('hora');			
			$sesion->semana       		 = Input::get('semana_tema');
			$sesion->tema_id     		 = Input::get('tema_id');
			$sesion->tema_adicional		 = Input::get('tema_adicional');
			$sesion->firma_docente		 = Input::get('firma_docente');
			$sesion->firma_vocero		 = Input::get('firma_vocero');
			$sesion->estado				 = '1';	
			$sesion->observacion_docente = Input::get('observacion_docente');	
			$sesion->fecha_sesion		 = Input::get('fecha_sesion');		
			$sesion->save();

			Session::flash('message', 'Sesion Registrada Exitosamente.');	
			return Redirect::back();

		}else{

			return Redirect::back()->withInput()->withErrors($validator); 
		}

	}else{
		Session::flash('mensaje', 'Error, No puedes crear mas sesiones para esta asignatura el dia de hoy.');	

		return Redirect::back();

	}
}

public function update(){
	$rules = array
	(
		'firma_vocero' 		=> 'required',		
		'observacion_vocero' 	=> 'min:4|max:100'		
		);

	$message = array
	(
		
		'firma_vocero.required' => '* Debes Firmar antes de guardar la sesion.',
		'observacion_vocero.min' => '* Las Obervaciones son minimo 4 caracteres',
		'observacion_vocero.max' => '* Las Obervaciones son Máximo 50 caracteres'
		
		);

	$validator = Validator::make(Input::All(), $rules, $message);

	if ($validator->passes()) {


		$sesion = Input::get('id_sesion');
		$sesion = Sesion::find($sesion);
		$sesion->asignacion_id  = Input::get('asignacion_id_edit');	
		$sesion->hora  = Input::get('hora_edit');	
		$sesion->semana  = Input::get('semana_edit');
		$sesion->tema_id  = Input::get('tema_id_edit');
		$sesion->tema_adicional  = Input::get('tema_adicional_edit');
		$sesion->firma_docente  = Input::get('firma_docente_edit');
		$sesion->firma_vocero		 = Input::get('firma_vocero');
		$sesion->estado  = Input::get('estado_edit');  
		$sesion->observacion_vocero	 = Input::get('observacion_vocero');
		$sesion->observacion_docente  = Input::get('observacion_docente_edit');	
		$sesion->fecha_sesion  = Input::get('fecha_sesion_edit');				
		$sesion->save();








		Session::flash('message', 'Firma Registrada Con Éxito.!!');	
		return Redirect::back();

	}else{


		return Redirect::back()->withInput()->withErrors($validator);  
	}



}

}
