<?php

class HomeController extends BaseController {


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
		return View::make('HomeController.reporte_semestral');
	}





	public function reporteDiario($programa_id)	{

		$resultado = Asignacion::where('id', $programa_id)->get();

		return View::make('HomeController.RegistroDiario')
		->with('resultado', $resultado);


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
	$rules = array
	(
		'tema_id'				=> 'required|min:1|max:15',	
		'asignacion_id' 		=> 'min:1|max:15',
		'hora' 					=> 'min:1|max:15',
		'semana' 				=> 'required|numeric|required',                    
		'tema_adicional' 		=> 'regex:/^[a-záéóóúàèìòùäëïöüñ\s]+$/i|min:5|max:50',
		'firma_docente' 		=> 'min:1|max:15',
		'firma_vocero'			=> 'min:1|max:15',
		'estado'				=> 'min:1|max:15',
		'observacion_vocero' 	=> 'min:5|max:50',
		'observacion_docente'	=> 'regex:/^[a-záéóóúàèìòùäëïöüñ\s]+$/i|min:5|max:50',
		'fecha_sesion' 			=> 'min:3|max:15',
		);

	$message = array
	(
		'tema_id.different:0' => 'Porfavor Seleccione un tema.',	
		'semana.required' => 'El campo semana es requerido.',
		'semana.max' => 'El campo semana no puede ser mayor a 3 caracteres.',
		'semana.min' => 'El campo semana no puede ser menor a 1 caracteres.',

		'semana.numeric' => 'El campo semana es numerico.',
		'tema_adicional.regex' => 'Sólo se aceptan letras.',
		'tema_adicional.min' => 'Mínimo 5 caracteres',
		'tema_adicional.max' => 'Máximo 50 caracteres',
		'observacion_vocero.regex' => 'Las Obervaciones Sólo se aceptan letras',
		'observacion_vocero.min' => 'Las ObervacionesMínimo son minimo 5 caracteres',
		'observacion_vocero.max' => 'Las ObervacionesMínimo son Máximo 50 caracteres',
		'observacion_docente.regex' => 'Las ObervacionesMínimo Sólo se aceptan letras.',
		'observacion_docente.min' => 'Mínimo 5 caracteres',
		'observacion_docente.max' => 'Máximo 50 caracteres'
		);

	$validator = Validator::make(Input::All(), $rules, $message);

	if ($validator->passes()) {


		$sesion = new Sesion;
		$sesion->asignacion_id 		= Input::get('asignacion_id');
		$sesion->hora				= Input::get('asignacion_id');			
		$sesion->semana       		= Input::get('semana');
		$sesion->tema_id     		= Input::get('tema_id');
		$sesion->tema_adicional		 = Input::get('tema_adicional');
		$sesion->firma_docente		 = Input::get('semana');
		$sesion->firma_vocero		 = Input::get('semana');
		$sesion->estado				 = '1';  
		$sesion->observacion_vocero = Input::get('observacion_vocero');
		$sesion->observacion_docente = Input::get('observacion_docente');	
		$sesion->touch();
		$sesion->save();
		$message= '<div class="alert alert-info"><strong>Excelente...</strong><button class="close" data-dismiss="alert" type="button">×</button>¡Registro almacenado!</div>';

		return Redirect::back()->with("message", $message);

	}else{

		return Redirect::back()->withInput()->withErrors($validator);  
	}

}

}
