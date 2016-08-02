<?php
class getsesionesController extends BaseController {
	public function postData()
	{


		$id_asignacion = Input::get('id_asignacion');	

		
		
		//$sesiones = Sesion::find($docente_id);
		
		$sesiones = Sesion::where('id', '=', $id_asignacion)->with('tema')->get();

		

		foreach($sesiones as $key => $user){
			$id=$user->id;
			$asignacion_id=$user->asignacion_id;
			$hora=$user->hora;
			$semana=$user->semana;
			$tema_id=$user->tema_id;
			$tema_adicional=$user->tema_adicional;
			$estado=$user->estado;
			$observacion_docente=$user->observacion_docente;
			$observacion_vocero=$user->observacion_vocero;
			$fecha_sesion=$user->fecha_sesion;
			$firma_docente=$user->firma_docente;
			$firma_vocero=$user->firma_vocero;
			$created_at=$user->created_at;
			$updated_at=$user->updated_at;
			$nombre_tema=$user->tema->nombre_tema;
		}

		$data = array(
			'success' => true,			
			'id' =>  $id,
			'asignacion_id' =>  $asignacion_id,
			'hora' =>  $hora,
			'semana' =>  $semana,
			'tema_id' =>  $tema_id,
			'tema_adicional' =>  $tema_adicional,
			'estado' =>  $estado,
			'observacion_docente' =>  $observacion_docente,
			'observacion_vocero' =>  $observacion_vocero,
			'fecha_sesion' =>  $fecha_sesion,			
			'firma_docente' =>  $firma_docente,
			'firma_vocero' =>  $firma_vocero,
			'created_at' =>  $created_at,
			'updated_at' =>  $updated_at,
			'nombre_tema' =>  $nombre_tema


			);

		return Response::json($data);
		
	}
}
?>